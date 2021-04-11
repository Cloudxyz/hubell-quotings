<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);

        if ($search) {
            $query = User::query();
            $query->where(function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%" . $search . "%");
                    $query->orWhere('email', 'like', "%" . $search . "%");
                });
                $query->orWhereHas('profile', function ($q) use ($search) {
                    $q->where('client_number', 'like', '%' . $search . '%');
                });
            });
        } else {
            $query = User::query();
        }

        $users = $query->paginate(15);
        $users->withPath('/system/users');
        return view('users.index')
            ->with('users', $users)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $brands = Brand::all();
        return view('users.create')
                ->with('roles', $roles)
                ->with('brands', $brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'email'     => 'required|unique:users|email',
            'firstname' => 'required|min:3',
            'password' => 'required|confirmed|min:6',
        ]);

        $user           = new User;
        $user->name     = $request->firstname;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            $profile = new Profile;
            $profile->user_id   = $user->id;
            $profile->lastname  = $request->lastname;
            $profile->country   = $request->country;
            $profile->state     = $request->state;
            $profile->city      = $request->city;
            $profile->street    = $request->street;
            $profile->zip       = $request->zip;
            $profile->phone     = $request->phone;
        }

        if($profile->save()){
            $request->session()->flash('success', __('Record created successfully'));
            $route = redirect()->route('users.edit', $user->id);
        }else{
            $request->session()->flash('error', __("Record can't be created"));
            $route = redirect('users.create')->withInput();
        }
        return $route;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $brands = Brand::all();
        return view('users.show')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('brands', $brands);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $brands = Brand::all();
        return view('users.edit')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('brands', $brands);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [];
        $rule['email'] = ['required', 'email', Rule::unique('users')->ignore($id)];
        $rule['firstname'] = 'required|min:3';
        if($request->password){
            $rule['password'] = 'confirmed|min:6';
        }
        $validated = $request->validate($rules);
        
        $roles = $request->roles;
        $user = User::find($id);
        if($user->name != $request->name){
            $user->name = $request->name;
        }
        if($user->email != $request->email){
            $user->email = $request->email;
        }
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        if($user->save()){
            $user->profile->fill($request->all());
        }
        if($user->profile->save()){
            $request->session()->flash('success', __('Record updated successfully'));
        }else{
            $request->session()->flash('error', __("Record can't be updated"));
        }
        if($roles){
            $user->syncRoles($roles);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        if($user){
            if($user->delete()){
                $request->session()->flash('success', __('Record deleted successfully'));
            }else{
                $request->session()->flash('error', __("Record can't be deleted"));
            }
        }

        return redirect()->back();
    }

}

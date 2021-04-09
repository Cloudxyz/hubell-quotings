<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
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
            $query = Brand::query();
            $query->where(function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%" . $search . "%");
                });
            });
        } else {
            $query = Brand::query();
        }

        $brands = $query->paginate(15);
        $brands->withPath('/system/brands');
        return view('brands.index')
            ->with('brands', $brands)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
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
            'name'   => 'required',
        ]);
        
        $brand = new Brand;
        $brand->name = $request->name;

        if($brand->save()){
            $request->session()->flash('success', __('Record created successfully'));
            $route = redirect()->route('brands.edit', $brand->id);
        }else{
            $request->session()->flash('error', __("Record can't be created"));
            $route = redirect()->back();
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
        $brand = Brand::find($id);
        return view('brands.show')
                ->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('brands.edit')
                ->with('brand', $brand);
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
        $validated = $request->validate([
            'name'   => 'required',
        ]);

        $brand = Brand::find($id);
        $brand->name = $request->name;
        if($brand->save()){
            $request->session()->flash('success', __('Record updated successfully'));
        }else{
            $request->session()->flash('error', __("Record can't be updated"));
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
        $brand = Brand::find($id);
        if($brand){
            if($brand->delete()){
                $request->session()->flash('success', __('Record deleted successfully'));
            }else{
                $request->session()->flash('error', __("Record can't be deleted"));
            }
        }

        return redirect()->back();
    }
}

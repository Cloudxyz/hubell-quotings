<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'brand'   => 'required',
            'discount' => 'required',
        ]);

        $getDiscount = Discount::where('user_id', $id)->where('brand_id', $request->brand)->first();
        if(!$getDiscount){
            $discount = new Discount;
        }else{
            $discount = $getDiscount;
        }
        $discount->user_id = $id;
        $discount->brand_id = $request->brand;
        $discount->discount = $request->discount;
        
        if($discount->save()){
            $request->session()->flash('success', __('Discount created successfully'));
        }else{
            $request->session()->flash('error', __("Discount can't be created"));
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $discount = Discount::find($id);
        if($discount){
            if($discount->delete()){
                $request->session()->flash('success', __('Discount deleted successfully'));
            }else{
                $request->session()->flash('error', __("Discount can't be deleted"));
            }
        }

        return redirect()->back();
    }
}

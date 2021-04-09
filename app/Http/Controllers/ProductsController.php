<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
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
            $query = Product::query();
            $query->where(function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('division', 'like', "%" . $search . "%");
                    $query->orWhere('brand', 'like', "%" . $search . "%");
                    $query->orWhere('material', 'like', "%" . $search . "%");
                    $query->orWhere('description', 'like', "%" . $search . "%");
                    $query->orWhere('amount', 'like', "%" . $search . "%");
                });
            });
        } else {
            $query = Product::query();
        }

        $products = $query->paginate(15);
        $products->withPath('/system/products');
        return view('products.index')
            ->with('products', $products)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'division'   => 'required',
            'brand' => 'required',
            'material' => 'required',
        ]);

        $product = new Product;
        $product->division         = $request->division;
        $product->brand            = $request->brand;
        $product->material         = $request->material;
        $product->amount           = $request->amount;
        $product->unit             = $request->unit;
        $product->min_package      = $request->min_package;
        $product->abc              = $request->abc;
        $product->description      = $request->description;
        $product->description_es   = $request->description_es;

        if($product->save()){
            $request->session()->flash('success', __('Record created successfully'));
            $route = redirect()->route('products.edit', $product->id);
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
        $product = Product::find($id);
        return view('products.show')
                ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit')
                ->with('product', $product);
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
            'division'   => 'required',
            'brand' => 'required',
            'material' => 'required',
        ]);

        $product = Product::find($id);
        $product->division         = $request->division;
        $product->brand            = $request->brand;
        $product->material         = $request->material;
        $product->amount           = $request->amount;
        $product->unit             = $request->unit;
        $product->min_package      = $request->min_package;
        $product->abc              = $request->abc;
        $product->description      = $request->description;
        $product->description_es   = $request->description_es;

        if($product->save()){
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
        $product = Product::find($id);
        if($product){
            if($product->delete()){
                $request->session()->flash('success', __('Record deleted successfully'));
            }else{
                $product->session()->flash('error', __("Record can't be deleted"));
            }
        }

        return redirect()->back();
    }

    public function import() 
    {
        Excel::import(new ProductsImport, storage_path('products_mxn.xlsx'));

        return redirect()->back();
    }
}

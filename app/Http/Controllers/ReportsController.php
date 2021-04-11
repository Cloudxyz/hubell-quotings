<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Quoting;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotings = Quoting::all();
        $productsTop = [];
        $clientsTop = [];
        $products = [];
        $clients = [];
        foreach($quotings as $quoting){
            $quotingProducts = json_decode($quoting->products);
            foreach($quotingProducts as $quotingProduct){
                $productsTop[] = $quotingProduct->material;
            }
            $clientsTop[] = $quoting->client;
        }

        $countProducts = array_count_values($productsTop);
        arsort($countProducts);
        $itemsProducts = array_slice(array_keys($countProducts), 0, 5, true);

        $countsClients = array_count_values($clientsTop);
        arsort($countsClients);
        $itemsClients = array_slice(array_keys($countsClients), 0, 5, true);

        foreach($itemsProducts as $item){
            $products[] = Product::where('material', $item)->first();
        }

        foreach($itemsClients as $item){
            $query = User::query();
            $query->whereHas('profile', function ($query) use ($item) {
                $query->where('client_number', 'like', "%" . $item . "%");
            });
            $clients[] = $query->first();
        }

        return view('reports.index')
            ->with('products', $products)
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}

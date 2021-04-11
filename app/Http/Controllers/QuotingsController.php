<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Quoting;

use PDF;

class QuotingsController extends Controller
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
            $query = Quoting::query();
            $query->where(function ($query) use ($search) {
                if(!current_user()->hasRole('Client')){
                    $query->where('client', 'like', "%" . $search . "%");
                    $query->orWhere('contact', 'like', "%" . $search . "%");
                }else{
                    $query->where('contact', 'like', "%" . $search . "%");
                }
                $query->orWhere('address', 'like', "%" . $search . "%");
                $query->orWhere('zone', 'like', "%" . $search . "%");
                $query->orWhere('project', 'like', "%" . $search . "%");
                $query->orWhere('duration', 'like', "%" . $search . "%");
                $query->orWhere('seller', 'like', "%" . $search . "%");
            });
        } else {
            $query = Quoting::query();
        }

        if(current_user()->hasRole('Client')){
            $query->where(function ($query) {
                $query->where('client', '=', current_user()->profile->client_number );
            });
        }


        $quotings = $query->paginate(15);
        $quotings->withPath('/system/quotings');
        return view('quotings.index')
            ->with('quotings', $quotings)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotings.create');
    }

    public function add(Request $request)
    {

        if($request->client){
            session(['client' => $request->client]);
        }

        if($request->contact){
            session(['contact' => $request->contact]);
        }

        if($request->address){
            session(['address' => $request->address]);
        }

        if($request->zone){
            session(['zone' => $request->zone]);
        }

        if($request->project){
            session(['project' => $request->project]);
        }

        if($request->duration){
            session(['duration' => $request->duration]);
        }

        if($request->seller){
            session(['seller' => $request->seller]);
        }
        
        $validated = $request->validate([
            'client'   => 'required',
            'material' => 'required',
        ]);

        if(session()->get('products')){
            $getproductsArr = json_decode(session()->get('products'));
            if(!empty($getproductsArr)){
                foreach($getproductsArr as $getProduct){
                    $productExist = ($request->material == $getProduct->material);
                }
            }else{
                $productExist = false;
            }
        }else{
            $getproductsArr = [];
            $productExist = false;
        };

        if(session()->get('totalUSD')){
            $totalUSD = session()->get('totalUSD');
        }else{
            $totalUSD = 0;
        }

        if(session()->get('totalMXN')){
            $totalMXN = session()->get('totalMXN');
        }else{
            $totalMXN = 0;
        }
        
        if(!$productExist){
            $products = Product::where('material', $request->material)->get();

            if(!$products->isEmpty()){
                $request->session()->flash('success', __('Product added successfully'));
            }else{
                $request->session()->flash('error', __("Product not exist"));
            }

            $productsArr = [];
            $discount = 0;
            foreach($products as $product){
                $search = [];
                $search['brand'] = $product->brand;
                $search['user'] = $request->client;
                $minPackage = trim(str_replace('PZ','',$product->min_package));
                $query = Discount::query();
                $query->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->whereHas('profile', function ($q) use ($search) {
                            $q->where('client_number', 'like', '%' . $search['user'] . '%');
                        });
                    });
                    $query->whereHas('brand', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search['brand'] . '%');
                    });
                });

                if($query->first()){
                    $discount = $query->first()->discount;
                }
                $product->discount = $discount.'%';
                $product->input_min = $minPackage;
                $product->quantity = $minPackage;
                $discount = $discount / 100;
                $discountAmount = $product->amount - ($product->amount * $discount);
                $product->total =  number_format($minPackage * $discountAmount, 2);
                if($product->unit == 'USD'){
                    $totalUSD += $product->total;
                }elseif($product->unit == 'MXN'){
                    $totalMXN += $product->total;
                }
                $productsArr[] = $product;
            }

            
            if(!empty($productsArr)){
                $productsArr = array_merge((array)$getproductsArr, $productsArr);
                $jsonproductsArr = json_encode($productsArr);
                session(['products' => $jsonproductsArr]);
                session(['totalUSD' => $totalUSD]);
                session(['totalMXN' => $totalMXN]);
            }
        }

        return redirect()->back()->withInput();
    }

    public function remove($id)
    {
        $totalUSD = session()->get('totalUSD');
        $totalMXN = session()->get('totalMXN');
        $products = (array) json_decode(session()->get('products'));
        foreach($products as $index => $product){
            if($id == $product->id){
                unset($products[$index]);
                if($product->unit == 'USD'){
                    $totalUSD -= $product->total;
                }else if($product->unit == 'MXN'){
                    $totalMXN -= $product->total;
                }
            }
        }
        
        if(!empty($products)){
            $jsonProducts = json_encode($products);
            session(['products' => $jsonProducts]);
            if($totalUSD <= 0){
                session()->forget('totalUSD');
            }else{
                session(['totalUSD' => $totalUSD]);
            }
            if($totalMXN <= 0){
                session()->forget('totalMXN');
            }else{
                session(['totalMXN' => $totalMXN]);
            }
        }else{
            //remove sessions of quoting
            session()->forget('products');
            session()->forget('totalUSD');
            session()->forget('totalMXN');
        }


        return redirect()->back()->withInput();
    }

    public function updateProduct(Request $request)
    {
        $products = json_decode(session()->get('products'));
        foreach($products as $product){
            if($product->material == $request->material){
                $product->quantity = $request->quantity;
                $product->total = $request->price;
            }
        }
        
        $jsonProducts = json_encode($products);

        session(['products' => $jsonProducts]);
        session(['totalUSD' => $request->totalUSD]);
        session(['totalMXN' => $request->totalMXN]);

        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(session()->get('quoting')){
            $quoting = Quoting::find(session()->get('quoting'));
        }else{
            $quoting = new Quoting;
        }
        $quoting->user_id   = current_user()->id;
        $quoting->client    = session()->get('client');
        $quoting->contact   = session()->get('contact');
        $quoting->address   = session()->get('address');
        $quoting->zone      = session()->get('zone');
        $quoting->project   = session()->get('project');
        $quoting->duration  = session()->get('duration');
        $quoting->seller    = session()->get('seller');
        $quoting->total_usd = (session()->get('totalUSD'))?session()->get('totalUSD'):0;
        $quoting->total_mxn = (session()->get('totalMXN'))?session()->get('totalMXN'):0;
        $quoting->products  = session()->get('products');

        if($quoting->save()){
            $request->session()->flash('success', __('Quoting created successfully'));

            //remove sessions of quoting
            session()->forget('client');
            session()->forget('contact');
            session()->forget('address');
            session()->forget('zone');
            session()->forget('project');
            session()->forget('duration');
            session()->forget('seller');
            session()->forget('products');
            session()->forget('totalUSD');
            session()->forget('totalMXN');

            return redirect()->route('quotings.index');
        }else{
            $request->session()->flash('error', __("Quoting can't be created"));
            return redirect()->back()->withInput();
        }
    }

    public function export($id)
    {
        $data = Quoting::find($id);
        view()->share('quoting', $data);
        $pdf = PDF::loadView('quotings.export', $data);
        $pdf->setPaper('a4', 'landscape');
        $fileName = "cotización-".$data->id.'.pdf';

        return $pdf->stream($fileName);
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
        $quoting = Quoting::find($id);
        session(['products' => $quoting->products]);
        session(['quoting' => $quoting->id]);
        session(['client' => $quoting->client]);
        session(['contact' => $quoting->contact]);
        session(['address' => $quoting->address]);
        session(['zone' => $quoting->zone]);
        session(['project' => $quoting->project]);
        session(['duration' => $quoting->duration]);
        session(['seller' => $quoting->seller]);
        session(['totalUSD' => $quoting->total_usd]);
        session(['totalMXN' => $quoting->total_mxn]);

        return redirect()->route('quotings.create');
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

    public function historial($id)
    {
        $audits = Quoting::find($id)->audits;
        return view('quotings.historial')
                ->with('audits', $audits);
    }
}

<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // get all orders
        $productTypes = ProductType::all();

        return $productTypes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = ProductType::create($request->all());
        if ($result['success']) {
            return response()->json([
                'status' => true,
                'order' => ProductType::find($result['data']->id)->get(),
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => $result['errors'],
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        return $productType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        $update = $productType->customUpdate($request->all());
        if ($update['success']) {
            return response()->json([
                'status' => true,
                'data' => ProductType::find($productType->id)->get(),
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => $update['errors'],
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        if ($productType->delete()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

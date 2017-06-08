<?php

namespace App\Http\Controllers;

use App\OutletType;
use Illuminate\Http\Request;
use App\Http\Requests\OutletTypeRequest;


class OutletTypeController extends Controller
{
    public function rules() {
        return [
            'name' => 'required',
        ];
    }

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
        $outletTypes = OutletType::all();

        return $outletTypes;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = OutletType::create($request->all());
        if ($result['success']) {
            return response()->json([
                'status' => true,
                'order' => OutletType::find($result['data']->id)->get(),
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
     * @param  \App\OutletType $outletType
     * @return \Illuminate\Http\Response
     */
    public function show(OutletType $outletType)
    {
        return $outletType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OutletType $outletType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutletType$outletType)
    {
        $update = $outletType->customUpdate($request->all());
        if ($update['success']) {
            return response()->json([
                'status' => true,
                'data' => OutletType::find($outletType->id)->get(),
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
     * @param  \App\OutletType $outletType
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutletType $outletType)
    {
        if ($outletType->delete()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
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
        // get all areas
        $areas = Area::all();

        return $areas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = Area::create($request->all());
        if ($result['success']) {
            return response()->json([
                'status' => true,
                'data' => Area::find($result['data']->id)->get(),
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
     * @param  \App\Area $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area$area)
    {
        return $area;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area$area)
    {
        $update = $area->customUpdate($request->all());
        if ($update['success']) {
            return response()->json([
                'status' => true,
                'data' => Area::find($area->id)->get(),
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
     * @param  \App\Area $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area$area)
    {
        if ($area->delete()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

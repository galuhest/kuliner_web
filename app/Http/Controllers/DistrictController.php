<?php

namespace App\Http\Controllers;

use App\Area;
use App\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function rules() {
        return [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ];
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of districts (subarea)
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $districts = District::all();

        return $districts;
    }

    /**
     * Store a new district (subarea)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = District::create($request->all());
        if ($result['success']) {
            return response()->json([
                'status' => true,
                'data' => District::find($result['data']->id)->get(),
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
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        return $district;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $update = $district->customUpdate($request->all());
        if ($update['success']) {
            return response()->json([
                'status' => true,
                'data' => District::find($district->id)->get(),
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
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        if ($district->delete()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function area(Request $request) {
        $districts = Area::where('district_id', $request->id)->get();
        return response()->json(['status' => true, 'data' => $districts]);
    }
}

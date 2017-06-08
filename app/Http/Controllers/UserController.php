<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // get all users
        $users = User::all();

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = User::create($request->all());
        if ($result['success']) {
            return response()->json([
                'status' => true,
                'data' => User::find($result['data']->id)->get(),
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $update = $user->customUpdate($request->all());
        if ($update['success']) {
            return response()->json([
                'status' => true,
                'data' => User::find($user->id)->get(),
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $status = $user->delete();

        if($status){
            $message = 'Success';
            $status_code = 200;
        } else {
            $message = 'Failed';
            $status_code = 500;
        }
        return response()->json(['status' => $status, 'message' => $message],$status_code);
    }

    public function getActivationCode(Request $request) {
        $user = User::find($request->id);
        $status = $user->generateActivationCode();
        return response()->json(['status' => $status , 'activation_code' => $user->activation_code]);
    }

    public function activateUser(Request $request) {
        $user = User::find($request->id);
        try {
            $status = $user->activate($request->activation_code);
            if($status){
                $message = 'Success';
                $status_code = 200;
            } else {
                $message = 'Failed';
                $status_code = 500;
            }
            return response()->json(['status' => $status, 'message' => $message],$status_code);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getMemberActivationCode(Request $request){
        $user = User::find($request->id);
        $status = $user->generateMemberActivationCode();
        return response()->json(['status' => $status , 'activation_code' => $user->member_activation_code]);
    }

    public function activateMember(Request $request){
        $user = User::find($request->id);
        try{
            $status = $user->activateMember($request->member_activation_code);
            if($status){
                $message = 'Success';
                $status_code = 200;
            } else {
                $message = 'Failed';
                $status_code = 500;
            }
            return response()->json(['status' => $status, 'message' => $message],$status_code);

        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}

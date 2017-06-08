<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Outlet;
use App\Area;
use App\User;
use App\OutletType;
use App\ProductType;
use App\Region;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function outlet(Request $request){
     $keywords = $request->keywords == null ? "" :  '%'.$request->keywords.'%';
     $outlets =  count($request->all()) == 0 ? Outlet::all() : Outlet::where($request->criteria ,'LIKE', '%'.$keywords.'%')->get();
     $areas = Area::all();
     $outletTypes = OutletType::all();
     $menuTypes = ProductType::all();
     return view('management/kedai',['outlets'=>$outlets, 'areas'=>$areas, 'outletTypes'=>$outletTypes, 'menuTypes'=>$menuTypes]);
    }

    public function customer(Request $request){
        $users = User::customer();
        $keywords = $request->keywords == null ? "" : $request->keywords;
        $users = count($request->all()) == 0 ? $users->get() : $users->where($request->criteria,'LIKE','%'.$keywords.'%')->get();
        return view('management/customer',['users' => $users]);

    }

    public function member(Request $request){
        $users = User::member();
        $keywords = $request->keywords == null ? "" : $request->keywords;
        $users = count($request->all()) == 0 ? $users->get() : $users->where($request->criteria,'LIKE','%'.$keywords.'%')->get();
        return view('management/member',['users' => $users]);
    }

    public function user(Request $request){
        $users = User::all();
        $keywords = $request->keywords == null ? "" : $request->keywords;
        $users = count($request->all()) == 0 ? $users : $users->where($request->criteria,'LIKE','%'.$keywords.'%')->get();
        return view('administration/user', ['users' => $users, 'roles' => User::getRoles()]);
    }

    public function outletType(Request $request){
        $outletTypes = OutletType::all();
        return view('administration/outlettype', ['outletTypes' => $outletTypes]);
    }

    public function productType(Request $request){
        $productTypes = ProductType::all();
        return view('administration/producttype', ['productTypes' => $productTypes]);
    }

    public function territory() {
        $regions = Region::all();
        return view('administration/territory', ['regions' => $regions]);
    }
}

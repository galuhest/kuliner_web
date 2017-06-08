<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductGroup;
use App\ProductType;
use App\Price;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MenuController extends Controller
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
        // get all Menus
        $Menus = Menu::all();

        return $Menus;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = Menu::create($request->all());

        if ($result['success']) {
            return response()->json([
                'status' => true,
                'data' => Product::find($result['data']->id)->get(),
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => $result['errors'],
            ], 400);
        }    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function show(Product $menu)
    {
        $menu->price = $menu->getCurrentPrice();
        return $menu;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $update = $product->customUpdate($request->all());
        if ($update['success']) {
            return response()->json([
                'status' => true,
                'data' => Product::find($product->id)->get(),
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
     * @param  \App\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
       $menu->delete($menu->id);
        return redirect("/administration/Menu");
    }

    public function menu($outlet_id, $product_group_id)
    {
        $menu = Product::where('outlet_id', $outlet_id)
                      ->where('product_group_id', $product_group_id)
                      ->select('products.id','products.id as second_id','outlet_id','name','description', 'product_type_id','product_group_id','is_favourite')->get();

        foreach ($menu as $m) {
            $m->price = $m->getCurrentPrice();
        }

        return $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menuGroup($outlet_id)
    {

        return ProductGroup::where('outlet_id', $outlet_id)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menuType()
    {
        return ProductType::all();
    }

    public function getPrice($product_id){
      return Price::where('product_id', $product_id)->get();
    }

    public function storePrice(Request $request){
      $result = Price::create($request->all());

      if ($result['success']) {
            return response()->json([
                'status' => true,
                'data' => Price::find($result['data']->id)->get(),
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => $result['errors'],
            ], 400);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMenu(Request $request)
    {
      $result = Product::create($request->all());

      if ($result['success']) {
            return response()->json([
                'status' => true,
                'data' => Product::find($result['data']->id)->get(),
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => $result['errors'],
            ], 400);
        }
    }

    public function storeMenuGroup(Request $request)
    {
        $result = ProductGroup::create($request->all());
        if ($result['success']) {
            return response()->json([
                'status' => true,
                'data' => ProductGroup::find($result['data']->id)->get(),
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => $result['errors'],
            ], 400);
        }
    }
}

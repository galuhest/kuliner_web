<?php

namespace App\Http\Controllers;

use App\Order;
use App\Outlet;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportingController extends Controller
{
 	public function __construct()
	{
	    $this->middleware('auth');
	}

	public function resume(Request $request) {
		$orders = Order::query();

		if (!empty($request->start_date)) {
			$orders = $orders->whereDate('date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
		}

		if (!empty($request->end_date)) {
			$orders = $orders->whereDate('date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
		}

		if (!empty($request->outlet)) {
			$orders = $orders->where('outlet_id', $request->outlet);
		}

		$orders = $orders->orderBy('date', 'DESC')->get();

		$data = [];
		foreach ($orders as $order) {
			if (!array_key_exists($order->date, $data)) {
				$data[$order->date] = [];
			}

			if (!array_key_exists($order->outlet_id, $data[$order->date])) {
				$data[$order->date][$order->outlet_id] = [];
			}

			array_push($data[$order->date][$order->outlet_id], $order);
		}

		$orderData = [];
		foreach ($data as $order) {
			foreach ($order as $ord) {
				$curr = (object)[
					'region' => $ord[0]->outlet->area->district->region->name,
					'district' => $ord[0]->outlet->area->district->name,
					'area' => $ord[0]->outlet->area->name,
					'outlet' => $ord[0]->outlet->name,
					'address' => $ord[0]->outlet->address,
					'date' => $ord[0]->date,
					'customer' => count($ord),
					'quantity' => 0,
					'discount' => 0,
					'subtotal' => 0,
					'delivery_cost' => 0,
					'infaq' => 0,
					'total' => 0,
				];

				foreach ($ord as $o) {
					$quantity = $o->details->sum('quantity');
					$subtotal = $o->getSubTotal();
					$discount = $o->getDiscount();
					$delivery_cost = 0;
					$infaq = $o->infaq;
					$total = $subtotal + $delivery_cost + $infaq - $discount;

					$curr->quantity += $quantity;
					$curr->discount += $discount;
					$curr->subtotal += $subtotal;
					$curr->delivery_cost += $delivery_cost;
					$curr->infaq += $infaq;
					$curr->total += $total;
				}

				$orderData[] = $curr;
			}
		}

		return view('reporting/resume', [
			'orderData' => $orderData,
			'outlets' => Outlet::all(),
			'request' => $request,
		]);	
	}

	public function customer(Request $request) {
		$orders = Order::query();

		if (!empty($request->start_date)) {
			$orders = $orders->whereDate('date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
		}

		if (!empty($request->end_date)) {
			$orders = $orders->whereDate('date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
		}

		if (!empty($request->outlet)) {
			$orders = $orders->where('outlet_id', $request->outlet);
		}

		return view('reporting/customer', [
			'orders' => $orders->get(),
			'outlets' => Outlet::all(),
			'request' => $request,
		]);	
	}

	public function detail(Request $request) {
		$orders = Order::query();

		if (!empty($request->start_date)) {
			$orders = $orders->whereDate('date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
		}

		if (!empty($request->end_date)) {
			$orders = $orders->whereDate('date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
		}

		if (!empty($request->outlet)) {
			$orders = $orders->where('outlet_id', $request->outlet);
		}

		return view('reporting/detail', [
			'orders' => $orders->get(),
			'outlets' => Outlet::all(),
			'request' => $request,
		]);	
	}
}
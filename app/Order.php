<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Order extends Model
{
    protected static $status = [0, 1, 2, 3];
    protected $fillable = ['date', 'outlet_id', 'customer_id', 'description', 'delivery_time', 'paid_amount', 'address', 'infaq', 'status'];
    protected $visible = ['id', 'date', 'outlet_id', 'customer_id', 'description', 'delivery_time', 'paid_amount', 'address', 'infaq', 'status'];

    protected $rules = [
        'outlet_id' => 'required|exists:outlets,id',
        'customer_id' => 'required|exists:users,id',
        'date' => 'required|date',
        'infaq' => 'integer|min:0',
        'paid_amount' => 'integer|min:0',
        'delivery_time' => 'nullable|date',
        'status' => 'integer',
    ];

    protected $errors;

    public function validate($data) {
        $v = Validator::make((array)$data, $this->rules);

        if ($v->fails()) {
            $this->errors = $v->errors()->toArray();
            return false;
        }
        return true;
    }

    public function errors() {
        return $this->errors;
    }
	
	public function customer()
    {
        return $this->belongsTo('App\User');
    }

    public function outlet()
    {
        return $this->belongsTo('App\Outlet');
    }

    public function delivery()
    {
        return $this->belongsToMany('App\Delivery');
    }

    public function details() {
        return $this->hasMany('App\OrderDetail');
    }

    public static function create($data) {
        if (!array_key_exists('details', $data)) {
            return [
                'success' => false,
                'errors' => 'Please input order details',
            ];
        }

        $order = new Order();
        if (!$order->validate($data)) {
            return [
                'success' => false,
                'errors' => $order->errors(),
            ];
        }

        $order->fill($data);
        if (!$order->save()) {
            return [
                'success' => false,
                'errors' => 'failed to save order',
            ];
        }

        $detailsData = [];
        $details = $data['details'];
        foreach ($details as $detail) {
            $detail['order_id'] = $order->id;
            $orderDetail = OrderDetail::create($detail);
            if (!$orderDetail['success']) {
                $order->rollback();
                return [
                    'success' => false,
                    'errors' => $orderDetail['errors'],
                ];   
            }
        }

        return [
            'success' => true,
            'data' => $order,
        ];
    }

    public function update(array $data = [], array $options = []) {
        $this->fill($data);
        if (!$this->validate($this->toArray())) {
            return [
                'success' => false,
                'errors' => $this->errors()
            ]; 
        }
        
        if (!$this->save()) {
            return [
                'success' => false,
                'errors' => 'failed to update data',
            ];
        }

        return [
            'success' => true,
            'data' => $this,
        ];
    }

    public function rollback() {
        $this->details()->delete();
        $this->delete();
        return true;
    }

    public function getData() {
        $data = $this->toArray();
        $details = [];
        foreach ($this->details as $detail) {
            $details[] = $detail->getData();
        }
        $data['details'] = $details;
        $data['subtotal'] = $this->getSubTotal();
        $data['discount'] = $this->getDiscount();
        $data['total'] = $data['subtotal'] - $data['discount'] + $data['infaq'];
        $data['status'] = $this->getStatusName();
        return $data;
    }

    public function getSubTotal() {
        $subtotal = 0;

        foreach ($this->details as $detail) {
            $subtotal += $detail->quantity * $detail->getCurrentPrice();
        }

        return $subtotal;
    }

    public function getDiscount() {
        $discount = Discount::where('outlet_id', $this->outlet_id)
                ->whereDate('start_date', '<=', $this->date)
                ->whereDate('end_date', '>=', $this->date)
                ->first();
        if (empty($discount)) {
            return 0;
        }
        return $this->getSubTotal() * ($discount->amount / 100);
    }

    public function getStatusName() {
        if ($this->status == 0) {
            return 'BELUM DITERIMA';
        } else if ($this->status == 1) {
            return 'DIANTAR';
        } else if ($this->status == 2) {
            return 'DITERIMA';
        }
    }
}
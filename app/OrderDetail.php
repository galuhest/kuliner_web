<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity'];
    protected $rules = [
        'order_id' => 'required|exists:orders,id',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
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
	
	public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public static function create($data) {
        $detail = new OrderDetail();
        if (!$detail->validate($data)) {
            return [
                'success' => false,
                'errors' => $detail->errors(),
            ];
        }

        $detail->fill($data);
        if (!$detail->save()) {
            return [
                'success' => false,
                'errors' => 'failed to save order detail',
            ];
        }

        return [
            'success' => true,
            'data' => $detail,
        ];
    }

    public function getData() {
        return [
            'item' => $this->product->name,
            'quantity' => $this->quantity,
            'price' => $this->getCurrentPrice(),
        ];
    }

    public function getCurrentPrice() {
        return $this->product->getCurrentPrice($this->order->date);
    }
}

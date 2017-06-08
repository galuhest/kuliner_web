<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
  protected $fillable = ['courrier_id', 'order_id', 'longitude', 'latitude'];

	public function courrier()
    {
        return $this->belongsTo('App\User');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}



<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['outlet_id', 'amount', 'start_date', 'end_date'];

    public function products()
    {
        return $this->hasMany('App\Outlet');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Product extends Model
{
	protected $fillable = ['outlet_id', 'name', 'description', 'product_type_id', 'product_group_id', 'is_favourite'];

    protected $rules = [
        'outlet_id' => 'required|exists:outlets,id',
        'name' => 'required|string',
        'product_type_id' => 'required|exists:product_types,id',
        'product_group_id' => 'required|exists:product_groups,id',
        'is_favourite' => 'required|boolean',
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

    public function outlet()
    {
        return $this->belongsTo('App\Outlet');
    }

    public function product_type()
    {
        return $this->belongsTo('App\ProductType');
    }

    public function outlet_type()
    {
        return $this->belongsTo('App\OutletType');
    }

    public static function create($data) {
      $product = new Product();
      if (!$product->validate($data)) {
          return [
              'success' => false,
              'errors' => $product->errors(),
          ];
      }

      $product->fill($data);
      if (!$product->save()) {
          return [
              'success' => false,
              'errors' => 'failed to save order',
          ];
      }
      return [
          'success' => true,
          'data' => $product,
      ];
    }

    public function customUpdate(array $data = [], array $options = []) {
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

    public function getCurrentPrice($date = date('Ymd')) {
        $product = Price::where('product_id', $this->id)
                        ->whereDate('start_date', '<=', $date)
                        ->where(function ($query) {
                            $query->whereDate('end_date', '>=', $date)
                                  ->orWhere('end_date', '=', null);
                        })
                        ->orderBy('start_date', 'DESC')
                        ->orderBy('updated_at', 'DESC')
                        ->first();

        if (empty($product)) {
            return null;
        }
        return $product->price;
    }
}

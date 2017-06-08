<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class ProductType extends Model
{
  protected $fillable = ['name'];

	protected $rules = [
	    'name' => 'required',
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

	public function products()
  {
      return $this->hasMany('App\Product');
  }

  public static function create($data) {
	  $productType = new ProductType();
	  if (!$productType->validate($data)) {
	      return [
	          'success' => false,
	          'errors' => $productType->errors(),
	      ];
	  }

	  $productType->fill($data);
    if (!$productType->save()) {
        return [
            'success' => false,
            'errors' => 'failed to save order',
        ];
    }
    return [
        'success' => true,
        'data' => $productType,
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
}

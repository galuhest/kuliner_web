<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class ProductGroup extends Model
{
  protected $fillable = ['name', 'outlet_id'];

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

	public static function create($data) {
	  $productGroup = new ProductGroup();
	  if (!$productGroup->validate($data)) {
	      return [
	          'success' => false,
	          'errors' => $productGroup->errors(),
	      ];
	  }

	  $productGroup->fill($data);
	  if (!$productGroup->save()) {
	      return [
	          'success' => false,
	          'errors' => 'failed to save order',
	      ];
	  }
	  return [
	      'success' => true,
	      'data' => $productGroup,
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

	public function outlet()
    {
        return $this->belongsTo('App\Outlet');
    }

	public function products()
    {
        return $this->hasMany('App\Product');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class OutletType extends Model
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

	public function outlets()
    {
        return $this->hasMany('App\Outlet');
    }

  public static function create($data) {
	  $outletType = new OutletType();
	  if (!$outletType->validate($data)) {
	      return [
	          'success' => false,
	          'errors' => $outletType->errors(),
	      ];
	  }

	  $outletType->fill($data);
    if (!$outletType->save()) {
        return [
            'success' => false,
            'errors' => 'failed to save order',
        ];
    }
    return [
        'success' => true,
        'data' => $outletType,
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

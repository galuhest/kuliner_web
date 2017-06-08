<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Region extends Model
{
	protected $fillable = ['name', 'longitude', 'latitude'];

	protected $rules = [
	    'name' => 'required',
	    'longitude' => 'required|numeric',
	    'latitude' => 'required|numeric',
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
	  $region = new Region();
	  if (!$region->validate($data)) {
	      return [
	          'success' => false,
	          'errors' => $region->errors(),
	      ];
	  }

	  $region->fill($data);
	  if (!$region->save()) {
	      return [
	          'success' => false,
	          'errors' => 'failed to save order',
	      ];
	  }
	  return [
	      'success' => true,
	      'data' => $region,
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

	public function districts()
    {
        return $this->hasMany('App\District');
    }
}

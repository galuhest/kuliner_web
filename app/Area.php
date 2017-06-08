<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Area extends Model
{
  protected $fillable = ['name', 'district_id', 'longitude', 'latitude'];

	protected $rules = [
			'district_id' => 'required|exists:districts,id',
	    'name' => 'required',
	    'longitude' => 'required|numeric',
	    'latitude' => 'required|numeric',
	  ];

	protected $messages = [
	    'district_id.required' => 'Silahkan pilih subarea terlebih dahulu.',
	    'district_id.exists' => 'Silahkan pilih subarea terlebih dahulu.',
		];

  protected $errors;

  public function validate($data) {
      $v = Validator::make((array)$data, $this->rules, $this->messages);

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
	  $area = new Area();
	  if (!$area->validate($data)) {
	      return [
	          'success' => false,
	          'errors' => $area->errors(),
	      ];
	  }

	  $area->fill($data);
	  if (!$area->save()) {
	      return [
	          'success' => false,
	          'errors' => 'failed to save order',
	      ];
	  }
	  return [
	      'success' => true,
	      'data' => $area,
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

	public function district()
    {
        return $this->belongsTo('App\District');
    }
}
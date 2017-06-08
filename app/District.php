<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class District extends Model
{
	protected $fillable = ['name', 'region_id', 'longitude', 'latitude'];

	protected $rules = [
			'region_id' => 'required|exists:regions,id',
	    'name' => 'required',
	    'longitude' => 'required|numeric',
	    'latitude' => 'required|numeric',
	  ];

	protected $messages = [
	    'region_id.required' => 'Silahkan pilih kawasan terlebih dahulu.',
	    'region_id.exists' => 'Silahkan pilih kawasan terlebih dahulu.',
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
	  $district = new District();
	  if (!$district->validate($data)) {
	      return [
	          'success' => false,
	          'errors' => $district->errors(),
	      ];
	  }

	  $district->fill($data);
	  if (!$district->save()) {
	      return [
	          'success' => false,
	          'errors' => 'failed to save order',
	      ];
	  }
	  return [
	      'success' => true,
	      'data' => $district,
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

	public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function areas()
    {
        return $this->hasMany('App\Area');
    }
}

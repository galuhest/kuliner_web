<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Carbon\Carbon;

class Price extends Model
{
	protected $fillable = ['product_id', 'price', 'start_date', 'end_date'];

	protected $rules = [
	    'product_id' => 'required|exists:products,id',
	    'price' => 'required|integer',
	    'start_date' => 'required|date',
	    'end_date' => 'nullable|date',
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

  public function product()
  {
      return $this->hasMany('App\Product');
  }

  public static function create($data) {
	  $price = new Price();
    if (!empty($data['start_date'])) {
      $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
    }

    if (!empty($data['end_date'])) {
      $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
    }

	  if (!$price->validate($data)) {
	      return [
	          'success' => false,
	          'errors' => $price->errors(),
	      ];
	  }

	  $price->fill($data);
	  if (!$price->save()) {
	      return [
	          'success' => false,
	          'errors' => 'failed to save price',
	      ];
	  }
	  return [
	      'success' => true,
	      'data' => $price,
	  ];
	}

	public function customUpdate(array $data = [], array $options = []) {
    if (!empty($data['start_date'])) {
      $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
    }

    if (!empty($data['end_date'])) {
      $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
    }

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

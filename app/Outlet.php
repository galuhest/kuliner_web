<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Outlet extends Model
{
    protected $fillable = ['name', 'outlet_type_id', 'area_id', 'description', 'longitude', 'latitude', 'address', 'status', 'is_favourite'];

    protected $rules = [
        'name' => 'required|string',
        'outlet_type_id' => 'required|exists:outlet_types,id',
        'area_id' => 'required|exists:areas,id',
        'longitude' => 'required|numeric',
        'latitude' => 'required|numeric',
        'address' => 'required|string',
        'status' => 'required|integer',
        'is_favourite' => 'boolean',
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

	public function outlet_type()
    {
        return $this->belongsTo('App\OutletType');
    }

    public function products()
    {
        return $this->belongsTo('App\Product');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function getStatusName(){
      return $this->status ? "AKTIF" : "NON AKTIF";
    }

    public static function create($data) {
      $outlet = new Outlet();
      if (!$outlet->validate($data)) {
          return [
              'success' => false,
              'errors' => $outlet->errors(),
          ];
      }

      $outlet->fill($data);
      if (!$outlet->save()) {
          return [
              'success' => false,
              'errors' => 'failed to save order',
          ];
      }
      return [
          'success' => true,
          'data' => $outlet,
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

<?php

namespace App;

use Carbon\Carbon;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const CUSTOMER = 0;
    const MEMBER = 1;
    const KURIR = 2;
    const ADMIN = 3;
    const ACTIVATION_CODE_LENGTH = 10;
    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'name', 'phone_number', 'address', 'member_activation_code', 'member_activation_date', 'activation_code', 'activation_date', 'role', 'status'
    ];

    protected $rules = [
        'email' => 'required|unique:users,email,',
        'password' => 'required',
        'name' => 'required',
        'phone_number' => 'required|numeric',
        'address' => 'required',
        'role' => 'required|numeric',
        'status' => 'required|boolean',
     ];

  protected $errors;

  public function validate($data) {
      $data['password'] = $this->password;
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


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function deliveries()
    {
        return $this->hasMany('App\Delivery');
    }

    public static function create($data) {
        $user = new User();
        $data['status'] = isset($data['status']) ? $data['status'] : User::INACTIVE;
        $data['role'] = isset($data['role']) ? $data['role'] : User::CUSTOMER;
        if(!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

          $user->fill($data);
          if (!$user->validate($data)) {
              return [
                  'success' => false,
                  'errors' => $user->errors(),
              ];
          }

          if (!$user->save()) {
              return [
                  'success' => false,
                  'errors' => 'failed to save user',
              ];
          }
          return [
              'success' => true,
              'data' => $user,
            ];
    }


    public function customUpdate($data) {
        if(!empty(array_key_exists('password', $data) && $data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $this->password;
        }

        $this->rules = [
            'email' => 'required|unique:users,email,' . $this->id,
            'password' => 'required',
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'address' => 'required',
         ];

        $this->fill($data);
        if (!$this->validate($this->toArray())) {
            return [
                'success' => false,
                'errors' => $this->errors(),
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

    public function isCustomer() {
        return $this->role == self::CUSTOMER;
    }

    public function  isMember(){
        return $this->role == self::MEMBER;
    }

    public function isKurir(){
        return $this->role == self::KURIR;
    }

    public function isAdmin(){
        return $this->role == self::ADMIN;
    }

    public static function getRoles() {
        return [
            (object) ['id' => self::CUSTOMER, 'name' => 'Pelanggan'],
            (object) ['id' => self::MEMBER, 'name' => 'Member'],
            (object) ['id' => self::KURIR, 'name' => 'Kurir'],
            (object) ['id' => self::ADMIN, 'name' => 'Administrator'],
        ];
    }

    public function getRoleName() {
        if ($this->isCustomer()) {
            return 'Pelanggan';
        } else if ($this->isMember()) {
            return 'Member';
        } else if ($this->isKurir()) {
            return 'Kurir';
        } else if ($this->isAdmin()) {
            return 'Administrator';
        } 
    }

    public function isActivated(){
        if($this->status == User::ACTIVE){
            return true;
        } else {
            return false;
        }
    }

    public static function scopeAdminUser($query){
        return $query->where('role', '>' , self::MEMBER);
    }

    public static function scopeCustomer($query){
        return $query->where('role','<=' , self::MEMBER);
    }

    public static function scopeMember($query){
        return $query->where('role',self::MEMBER);
    }

    public function generateActivationCode() {
        $this->activation_code = str_random(User::ACTIVATION_CODE_LENGTH);
        return $this->save();
    }

    public function activate($activation_code){
        if($this->isActivated()) {
            throw new \Exception('User has been activated');
        } else if ($this->activation_code == $activation_code) {
            $this->activation_date = Carbon::now();
            $this->status = self::ACTIVE;
            return $this->save();
        } else {
            throw new \Exception('Activation code is invalid');
        }
    }

    public function generateMemberActivationCode(){
        $this->member_activation_code = str_random(self::ACTIVATION_CODE_LENGTH);
        return $this->save();
    }

    public function activateMember($member_activation_code){
        if($this->isMember()){
            throw new \Exception('User already a member');
        } else if($this->member_activation_code == $member_activation_code){
            $this->member_activation_date = Carbon::now();
            $this->role = self::MEMBER;
            return $this->save();
        } else {
            throw new \Exception('Activation code is invalid');
        }
    }
}

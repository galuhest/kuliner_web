<?php

use Illuminate\Database\Seeder;
use App\OutletType;
use App\Area;
use App\District;
use App\Region;
use App\User;
use App\Outlet;
use App\ProductType;
use App\ProductGroup;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'caleb' ,'email' => 'test@admin.com' , 'password' => 'adminadmin','phone_number' => '0812121212' ,
            'address' => 'jalan jalan' , 'role' => User::ADMIN , 'status' => 1]);

        //Customer Seeder
        User::create(['name' => 'member 1' ,'email' => 'member1@admin.com' , 'password' => 'adminadmin','phone_number' => '0812121212' ,
            'address' => 'jalan jalan' , 'role' => User::CUSTOMER , 'status' => 0]);
        User::create(['name' => 'customer 1' ,'email' => 'customer1@admin.com' , 'password' => 'adminadmin','phone_number' => '0812121212' ,
            'address' => 'jalan jalan' , 'role' => User::CUSTOMER , 'status' => 0]);
        User::create(['name' => 'member 2' ,'email' => 'member2@admin.com' , 'password' => 'adminadmin','phone_number' => '0812121212' ,
            'address' => 'jalan jalan' , 'role' => User::CUSTOMER , 'status' => 0]);
        User::create(['name' => 'customer 3' ,'email' => 'customer3@admin.com' , 'password' => 'adminadmin','phone_number' => '0812121212' ,
            'address' => 'jalan jalan' , 'role' => User::CUSTOMER , 'status' => 0]);
        User::create(['name' => 'customer 4' ,'email' => 'customer4@admin.com' , 'password' => 'adminadmin','phone_number' => '0812121212' ,
            'address' => 'jalan jalan' , 'role' => User::CUSTOMER , 'status' => 0]);

        OutletType::create(['name' => 'Kedai Makanan']);
        OutletType::create(['name' => 'Toko Kelontong']);
        OutletType::create(['name' => 'Supermarket']);

        ProductType::create(['name' => 'Makanan']);
        ProductType::create(['name' => 'Minuman']);
        ProductType::create(['name' => 'Sembako']);

        $region = Region::create([
          'name'=>'JABODETABEK',
          'longitude'=>-37.866963,
          'latitude'=>144.980615,
        ]);
        
        $district = District::create([
          'region_id'=>$region['data']->id,
          'name'=>'Cibubur',
          'longitude'=>-37.866963,
          'latitude'=>144.980615,
        ]);

        $area = Area::create([
          'district_id'=>1,
          'name'=>'KOTA WISATA',
          'longitude'=>-37.866963,
          'latitude'=>144.980615,
        ]);

        $outlet = Outlet::create(['name' => 'Kedai A', 'outlet_type_id' => 1, 'area_id' => $area['data']->id, 'address' => 'Jalan A1 No. 2', 'longitude' => 6.4933, 'latitude' => 36.328, 'status' => true]);

        ProductGroup::create(['outlet_id' => $outlet['data']->id, 'name' => 'Makanan']);
    }
}

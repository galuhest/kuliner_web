<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 100)->unique();
            $table->string('password');
            // user profile
            $table->string('name', 100);
            $table->string('phone_number', 20);
            $table->text('address');
            // membership
            $table->string('activation_code')->nullable();
            $table->date('activation_date')->nullable();
            $table->string('member_activation_code')->nullable();
            $table->date('member_activation_date')->nullable();
            $table->integer('role')->default('0');
            $table->integer('status')->default('1');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

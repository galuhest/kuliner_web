<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('outlet_type_id')->unsigned();
            $table->foreign('outlet_type_id')->references('id')->on('outlet_types');
            $table->text('description')->nullable();
            $table->text('address');
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->float('longitude');
            $table->float('latitude');
            $table->integer('status')->default('1');
            $table->boolean('is_favourite')->default(false);
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
        Schema::dropIfExists('outlets');
    }
}

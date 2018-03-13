<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('governate_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('village_id')->unsigned();
            $table->integer('patient_id')->unsigned();

            $table->foreign('governate_id')->references('id')->on('governates')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('cities')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('village_id')->references('id')->on('villages')
            ->onDelete('cascade')
            ->onUpdate('cascade'); 
            $table->foreign('patient_id')->references('id')->on('patients')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            
           
            
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
        Schema::dropIfExists('addresses');
    }
}

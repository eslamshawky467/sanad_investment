<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->double('total_price', 30, 10);
            $table->double('unit_price', 30, 10);
            $table->integer('total_units');
            $table->integer('min_investement');
            $table->dateTime('last_investement_date');
            $table->double('investement_percentage', 10, 6);
            $table->double('penefits_from_investement', 10, 6);
            $table->string('lang');
            $table->string('lat');
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
        Schema::dropIfExists('properties');
    }
}

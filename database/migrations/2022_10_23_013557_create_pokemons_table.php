<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique();
            $table->integer('total')->nullable(false);
            $table->integer('hp')->nullable(false);
            $table->integer('attack')->nullable(false);
            $table->integer('defence')->nullable(false);
            $table->integer('special_attack')->nullable(false);
            $table->integer('special_defence')->nullable(false);
            $table->integer('speed')->nullable(false);
            $table->integer('generation')->nullable(false);
            $table->boolean('legendary')->default(false);
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
        Schema::dropIfExists('pokemons');
    }
}

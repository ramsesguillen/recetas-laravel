<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('ingredientes');
            $table->text('preparacion');
            $table->string('imagen');
            $table->unsignedBigInteger('user_id')->index('user_id')->comment('El usuario que crea la receta');
            $table->unsignedBigInteger('categoria_id')->index('categoria_id')->comment('La categoria de la receta');

            // $table->unsignedBigInteger('user_id')->comment('El usuario que crea la receta');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->unsignedBigInteger('categoria_id')->comment('La categoria de la receta');
            // $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
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
        Schema::dropIfExists('recetas');
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // Schema::drop('users');
        // Schema::drop('recetas');
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeRecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_receta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index('user_id')->comment('El usuario que crea la receta');
            $table->unsignedBigInteger('receta_id')->index('receta_id')->comment('El usuario que crea la receta');
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
        Schema::dropIfExists('like_receta');
    }
}

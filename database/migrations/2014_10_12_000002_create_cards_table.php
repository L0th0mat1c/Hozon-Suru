<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->longText("description");
            $table->string('adress');
            $table->string('siret_number')->nullable();
            $table->string('url_site')->nullable();
            $table->float("price");
            $table->string("background_image")->nullable();
            $table->integer("articles_number");
            $table->string("allergenes")->nullable();
            $table->boolean('display')->default(false);
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}

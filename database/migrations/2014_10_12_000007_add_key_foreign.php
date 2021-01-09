<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeyForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // Schema::table('sellers', function (Blueprint $table) {

        //     $table->unsignedBigInteger('user_id');
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        //     $table->unsignedBigInteger('category_id');
        //     $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        //     $table->unsignedBigInteger('location_id');
        //     $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

        //     Schema::enableForeignKeyConstraints();
        // });

        Schema::table('cards', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            // $table->unsignedBigInteger('seller_id');
            // $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');

            

            Schema::enableForeignKeyConstraints();
        });

        Schema::table('sales', function (Blueprint $table) {
            
            // $table->unsignedBigInteger('seller_id');
            // $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('card_id');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');

            Schema::enableForeignKeyConstraints();
        });
    
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('sellers', function (Blueprint $table) {
        //     //
        //     Schema::disableForeignKeyConstraints();
        //     $table->dropForeign('user_id');
        //     $table->dropColumn('user_id');
            
        //     $table->dropForeign('category_id');
        //     $table->dropColumn('category_id');

        //     $table->dropForeign('location_id');
        //     $table->dropColumn('location_id');

        // });

        Schema::table('cards', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();

            $table->dropForeign('user_id');
            $table->dropColumn('user_id');
            
            $table->dropForeign('category_id');
            $table->dropColumn('category_id');

            $table->dropForeign('location_id');
            $table->dropColumn('location_id');
            // $table->dropForeign('seller_id');
            // $table->dropColumn('seller_id');
           

            
        });
        Schema::table('sales', function (Blueprint $table) {
            //
            Schema::disableForeignKeyConstraints();
            // $table->dropForeign('seller_id');
            // $table->dropColumn('seller_id');
            $table->dropForeign('user_id');
            $table->dropColumn('user_id');
            $table->dropForeign('card_id');
            $table->dropColumn('card_id');

        });
    }
}

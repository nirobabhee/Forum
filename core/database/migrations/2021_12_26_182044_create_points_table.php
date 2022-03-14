<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->integer('post_point')->default(0);
            $table->integer('comment_point')->default(0);
            $table->integer('register_point')->default(0);
            $table->double('purchases_price_per_point,28,8')->default(0);
            $table->double('sales_price_per_point,28,8')->default(0);
            $table->integer('withdraw_limit_point')->default(0);
            $table->double('withdraw_limit_sales_price,28,8')->default(0);
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
        Schema::dropIfExists('points');
    }
}

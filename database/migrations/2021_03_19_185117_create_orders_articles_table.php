<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_articles', function (Blueprint $table) {
            $table->bigIncrements('ArticleId');
            $table->bigInteger('OrderId')->unsigned();
            $table->string('ArticleCode');
            $table->string('ArticleName')->nullable();
            $table->float('UnitPrice',14,2);
            $table->integer('Quantity');
            $table->timestamps();
            $table->foreign('OrderId')->references('OrderId')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_articles');
    }
}

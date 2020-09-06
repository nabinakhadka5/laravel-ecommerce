<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class  CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('sub_cat_id')->nullable();
            $table->text('summary');

            $table->longText('description')->nullable();
            $table->float('price')->unsigned();
            $table->float('discount')->unsigned()->nullable();
            $table->float('actual_price')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->string('brand')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->enum('status',['active','inactive','out_of_stock'])->default('inactive');

            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('sub_cat_id')->references('id')->on('categories')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');

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
        Schema::dropIfExists('products');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('selected')->default(0);
            $table->bigInteger('category_id')->unsigned();
            $table->string('code', 155);
            $table->integer('srp')->default(0);
            $table->text('description');
            $table->integer('cost')->default(0);

            $table->integer('qty')->default(0);
            $table->string('image', 155);

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

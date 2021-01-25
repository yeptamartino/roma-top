<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->unsignedBigInteger('catalog_id')->nullable();
            $table->foreign('catalog_id')
                ->references('id')->on('catalogs')
                ->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')
                ->references('id')->on('warehouses')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}

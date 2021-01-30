<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompositesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_id')->nullable();
            $table->foreign('catalog_id')
                ->references('id')->on('catalogs')
                ->onDelete('cascade');
            $table->unsignedBigInteger('composite_id')->nullable(); 
            $table->foreign('composite_id')
                ->references('id')->on('catalogs')
                ->onDelete('cascade');
            $table->float('amount', 8, 2);
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
        Schema::dropIfExists('composites');
    }
}

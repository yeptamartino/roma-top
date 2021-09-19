<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('first_visit')->nullable();
            $table->date('last_visit')->nullable();
            $table->integer('total_visit')->nullable();
            $table->integer('total_paid')->nullable();
            $table->integer('point')->nullable();
            $table->longText('note')->nullable();
            $table->string('thumbnail')->nullable();
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
        Schema::dropIfExists('customers');
    }
}

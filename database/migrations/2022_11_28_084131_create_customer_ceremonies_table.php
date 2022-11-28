<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCeremoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_ceremonies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned()->index()->nullable();
            $table->foreign('student_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('ceremony_id')->unsigned()->index()->nullable();
            $table->foreign('ceremony_id')->references('id')->on('ceremonies')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('time')->nullable();
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
        Schema::dropIfExists('customer_ceremonies');
    }
}

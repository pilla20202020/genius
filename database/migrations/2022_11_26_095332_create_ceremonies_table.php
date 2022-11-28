<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCeremoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceremonies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('graduation_id')->unsigned()->index()->nullable();
            $table->foreign('graduation_id')->references('id')->on('graduations')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->string('location')->nullable();
            $table->string('display_order')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status',['active','finished'])->nullable()->default('active');
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('ceremonies');
    }
}

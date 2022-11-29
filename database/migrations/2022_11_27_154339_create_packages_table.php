<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->string('price')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('type',['main','other'])->nullable()->default('main');
            $table->enum('presentation_photo',['active','in_active'])->nullable()->default('in_active');
            $table->enum('studio_photo',['active','in_active'])->nullable()->default('in_active');
            $table->string('display_order')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('packages');
    }
}

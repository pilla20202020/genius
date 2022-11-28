<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned()->index()->nullable();
            $table->foreign('institution_id')->references('id')->on('institutions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('faculty')->nullable();
            $table->string('color_code')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['active','in_active'])->nullable()->default('active');
            $table->string('display_order')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('graduations');
    }
}

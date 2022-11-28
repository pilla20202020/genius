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
            $table->string('student_id')->unique();
            $table->bigInteger('graduation_id')->unsigned()->index()->nullable();
            $table->foreign('graduation_id')->references('id')->on('graduations')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('ceremony_id')->unsigned()->index()->nullable();
            $table->foreign('ceremony_id')->references('id')->on('ceremonies')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('alternative_email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('password');
            $table->string('display_order')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status',['register','eligible','incompleter'])->nullable()->default('eligible');
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
        Schema::dropIfExists('customers');
    }
}

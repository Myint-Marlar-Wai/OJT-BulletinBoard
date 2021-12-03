<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile', 255);
            $table->integer('type')->default('1');
            $table->string('phone', 20)->nullable();
            $table->string('address', 255)->nullable();
            $table->date('dob')->nullable();
            $table->Integer('create_user_id')->unsigned()->nullable();
            $table->foreign('create_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->Integer('updated_user_id')->unsigned()->nullable();
            $table->foreign('updated_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->Integer('deleted_user_id')->unsigned()->nullable();
            $table->foreign('deleted_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->string('menuroles')->nullable(); //CoreUI

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();

            $table->boolean('banned')->nullable()->default(false);
            $table->string('locale', 4)->default('en');
            $table->string('device_uuid')->nullable();
            $table->text('fcm_token')->nullable();
            $table->boolean('notification_toggle')->default(true);
            $table->string('os')->nullable();
            $table->string('last_session_id')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_ip')->nullable();

            $table->rememberToken();
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

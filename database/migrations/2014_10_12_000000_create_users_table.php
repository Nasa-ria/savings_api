<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('subscription')->nullable();
            $table->string('next_of_kin_fullname')->nullable();
            $table->string('next_of_kin_address')->nullable();
            $table->string('next_of_kin_contact')->nullable();
            $table->boolean('user')->default(true);
            $table->string('balance')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

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
            $table->uuid('id')->primary();
            $table->string('username')->index();
            $table->string('email')->nullable();
            $table->unsignedTinyInteger('role')->default(USER_ROLE)->index();
            $table->string('name');
            $table->unsignedTinyInteger('gender')->nullable()->default(MALE_GENDER);
            $table->date('birthday')->nullable();
            $table->string('avatar')->nullable();
            $table->string('wallet_address')->nullable();
            $table->unsignedDecimal('balance', 12, 3)->default(0);
            $table->unsignedDecimal('blocked_balance', 12, 3)->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
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

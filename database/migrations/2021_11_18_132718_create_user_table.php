<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedInteger('kind')->comment('1: User, 2: Creator, 3: Client, 4: Referral');
            $table->string('name', 256);
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedTinyInteger('sex')->nullable();
            $table->date('birthday')->nullable();
            $table->string('avatar', 256)->nullable();
            $table->string('wallet_addr', 256)->nullable();
            $table->unsignedInteger('ballance')->nullable();
            $table->unsignedInteger('locked_ballance')->nullable();

            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}

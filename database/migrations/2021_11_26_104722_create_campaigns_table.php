<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('game_id')->nullable()->index(); // TODO xoa
            $table->uuid('content_id')->index();
            $table->unsignedTinyInteger('content_type')->nullable()->comment('1: game, 2: learning');
            $table->decimal('total_budget', 12, 7)->default(0);
            $table->decimal('creator_budget', 12, 7)->default(0);
            $table->decimal('referral_budget', 12, 7)->default(0);
            $table->decimal('user_budget', 12, 7)->default(0);
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
}

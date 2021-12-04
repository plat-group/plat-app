<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_referrals', function (Blueprint $table) {
            $table->uuid('campaign_id');
            $table->uuid('referral_id');

            // $table->timestamp('created_at')->nullable();
            $table->timestamps();

            $table->index(['campaign_id', 'referral_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_referrals');
    }
}

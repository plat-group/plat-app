<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('client_id')->index();
            $table->uuid('game_template_id')->index();
            $table->uuid('game_id')->nullable();
            $table->text('content')->nullable();
            $table->decimal('agreement_amount', 12, 7)->default(0);
            $table->decimal('royalty_fee', 12, 7)->default(0);
            $table->unsignedTinyInteger('status')->default(ORDERING_ORDER_STATUS);
            $table->string('resource_file')->nullable();
            $table->string('game_file')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

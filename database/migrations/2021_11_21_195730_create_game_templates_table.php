<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('creator_id')->index();
            $table->string('name');
            $table->string('introduction')->nullable();
            $table->text('description')->nullable();
            $table->string('thumb')->nullable();
            $table->string('file')->nullable();
            $table->string('demo_url')->nullable();
            $table->unsignedTinyInteger('status')->default(CREATING_GAME_STATUS);
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
        Schema::dropIfExists('game_templates');
    }
}

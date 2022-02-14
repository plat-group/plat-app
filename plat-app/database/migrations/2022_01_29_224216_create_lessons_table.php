<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('course_id');
            $table->string('name');
            $table->text('content_url');
            $table->tinyInteger('content_type')->default(0)->comment('0: video, 1: pdf, 2: powerpoint, 3:word, 4: excel');
            $table->text('content_description');
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
        Schema::dropIfExists('lessons');
    }
}

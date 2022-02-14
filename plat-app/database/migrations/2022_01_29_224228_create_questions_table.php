<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('lesson_id');
            $table->unsignedInteger('question_point');
            $table->text('question');
            $table->string('answer1')->comment('Câu hỏi có thể có nhiều câu trả lời đúng');
            $table->string('answer2')->nullable();
            $table->string('answer3')->nullable();
            $table->string('answer4')->nullable();
            $table->string('answer5')->nullable();
            $table->string('answer6')->nullable();
            $table->string('answer7')->nullable();
            $table->string('answer8')->nullable();
            $table->string('answer9')->nullable();
            $table->string('answer10')->nullable();
            $table->unsignedTinyInteger('correct_answer')->comment('1-10');
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
        Schema::dropIfExists('questions');
    }
}

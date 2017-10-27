<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 200)->unique();
            $table->string('title', 255);
            $table->integer('author_id')->unsigned();
            $table->string('score_image', 255);
            $table->string('score_url', 255);
            $table->string('score_sound_format', 255)->nullable();
            $table->string('score_sound_url', 255)->nullable();
            $table->integer('count_votes')->default(0);
            $table->integer('avg_votes')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}

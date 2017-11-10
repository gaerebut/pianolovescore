<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateKeywordsScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords_scores', function (Blueprint $table) {
            $table->integer('keyword_id')->unsigned();
            $table->integer('score_id')->unsigned();
            $table->timestamps();
            $table->foreign('keyword_id')->references('id')->on('keywords');
            $table->foreign('score_id')->references('id')->on('scores');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keywords_scores');
    }
}
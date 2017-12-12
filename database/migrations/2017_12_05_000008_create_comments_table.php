<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('score_id')->unsigned();
            $table->string('username', 190);
            $table->text('comment');
            $table->ipAddress('ip_address');
            $table->boolean('is_online')->default(0);
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('comments');
    }
}

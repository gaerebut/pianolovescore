<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score_id')->unsigned()->nullable();
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('contact_lastname', 255);
            $table->string('contact_firstname', 255);
            $table->string('contact_email', 255);
            $table->text('contact_message')->nullable();
            $table->text('admin_message')->nullable();
            $table->integer('state')->default(0);
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('scores_requests');
    }
}

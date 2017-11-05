<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('contact_lastname', 255);
            $table->string('contact_firstname', 255);
            $table->string('contact_email', 255);
            $table->integer('state')->default(0);
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_requests');
    }
}

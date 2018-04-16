<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlossariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glossaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug_fr', 150);
            $table->string('slug_en', 150);
            $table->string('glossary_fr', 100);
            $table->string('glossary_en', 100);
            $table->text('description_fr');
            $table->text('descriptio_en');
            $table->string('image', 190)->nullable();
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
        Schema::dropIfExists('glossaries');
    }
}

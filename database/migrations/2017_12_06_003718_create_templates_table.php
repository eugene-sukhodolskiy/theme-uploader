<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_cms')->unsigned();
            //$table->foreign('meta_cms')->referenses('id')->on('meta');
            $table->longText('preview');
            $table->dateTime('date_at_create');
            $table->string('link_on_demo');
            $table->string('name');
            $table->text('meta_browsers');
            $table->text('meta_tech');
            $table->text('meta_file_type');
            $table->integer('count_column');
            $table->integer('meta_layout');
            $table->text('description');
            $table->integer('keyword_id')->unsigned();
            //$table->foreign('keyword_id')->referenses('id')->on('keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag')->unique();
            $table->timestamps();
        });

        Schema::create('blog_tag', function (Blueprint $table) {
           $table->bigInteger('blog_id')->unsigned();
           $table->bigInteger('tag_id')->unsigned();

           $table->unique(['blog_id' ,'tag_id']);

           $table->foreign('tag_id')->references('id')->on('tags');
           $table->foreign('blog_id')->references('id')->on('blogs');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_tag');
        Schema::dropIfExists('tags');

    }
}

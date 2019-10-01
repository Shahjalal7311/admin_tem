<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->string('image_name')->nullable();
            $table->string('thum_img')->nullable();
            $table->tinyInteger('is_delete')->default('1');
            $table->tinyInteger('is_active')->default('1');
            $table->tinyInteger('status')->default('1');
            $table->unsignedInteger('user_rmd_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('articals');
    }
}

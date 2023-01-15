<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id('list_id');
            $table->string('title');
            $table->enum('purpose', ['B', 'S', 'R']);
            $table->string('image');
            $table->string('price');
            $table->text('description');
            $table->string('author_id');
            $table->string('city');
            $table->string('address');
            $table->string('Contact');
            $table->enum('status', ['A', 'B', 'P']);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories'); 
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
        Schema::dropIfExists('listings');
    }
};

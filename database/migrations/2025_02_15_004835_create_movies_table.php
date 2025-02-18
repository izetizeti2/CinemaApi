<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('movies', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Lidhja me kategoritë
        $table->string('director');
        $table->date('release_date');
        $table->text('synopsis');
        $table->string('poster'); // Kolona për posterin, e detyrueshme
        $table->timestamps();
    });
}


    
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}

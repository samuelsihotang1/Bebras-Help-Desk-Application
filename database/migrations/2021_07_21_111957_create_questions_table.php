<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('questions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
      $table->string('title', 120);
      $table->string('title_slug')->unique();
      $table->string('status')->nullable();
      $table->string('pin_answer')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('questions');
  }
}

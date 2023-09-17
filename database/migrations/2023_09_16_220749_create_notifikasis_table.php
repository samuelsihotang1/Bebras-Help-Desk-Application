<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('notifikasis', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
      $table->enum('type', ['question', 'answer', 'comment', 'user', 'others', 'topic'])->default('others');
      $table->string('text', 100);
      $table->enum('viewed', ['true', 'false'])->default('false');
      $table->string('slug_link', 100);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('notifikasis');
  }
};

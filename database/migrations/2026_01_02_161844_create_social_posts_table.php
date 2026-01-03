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
        Schema::create('social_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('platform'); // instagram, linkedin, facebook, etc.
            $table->string('type'); // lifehack, techhack, promo, etc.
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->json('metadata')->nullable(); // Pour stocker des hashtags, mentions, etc.
            $table->date('scheduled_date')->nullable();
            $table->string('status')->default('draft'); // draft, scheduled, published
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('social_posts');
    }
};
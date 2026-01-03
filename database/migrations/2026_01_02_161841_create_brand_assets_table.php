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
        Schema::create('brand_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // logo, favicon, color, typography, etc.
            $table->string('category'); // main, variation, seasonal, etc.
            $table->string('file_path')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable(); // Pour stocker des données supplémentaires
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
        Schema::dropIfExists('brand_assets');
    }
};
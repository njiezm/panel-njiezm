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
        Schema::table('files', function (Blueprint $table) {
            // Ajoute la colonne pour différencier les fichiers des dossiers
            $table->enum('type', ['file', 'folder'])->default('file')->after('user_id');
            
            // On met à jour l'index pour de meilleures performances
            $table->dropIndex(['user_id', 'folder']);
            $table->index(['user_id', 'type', 'folder']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropIndex(['user_id', 'type', 'folder']);
            $table->index(['user_id', 'folder']);
        });
    }
};
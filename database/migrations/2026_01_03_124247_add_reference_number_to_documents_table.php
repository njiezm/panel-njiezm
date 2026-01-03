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
        Schema::table('documents', function (Blueprint $table) {
            $table->integer('reference_number')->nullable()->after('id');
            
            // Ajouter un index unique pour le type et le numéro de référence
            $table->unique(['type', 'reference_number']);
        });
        
        // Mettre à jour les documents existants avec des numéros de référence
        DB::statement('
            UPDATE documents d1 
            SET reference_number = (
                SELECT COUNT(*) + 1 
                FROM documents d2 
                WHERE d2.type = d1.type AND d2.id < d1.id
            )
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropUnique(['type', 'reference_number']);
            $table->dropColumn('reference_number');
        });
    }
};
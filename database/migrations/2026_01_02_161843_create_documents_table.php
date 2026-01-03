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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // invoice, quote, contract, etc.
            $table->string('client_name');
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('issue_date');
            $table->date('due_date');
            $table->string('status')->default('draft'); // draft, sent, paid, overdue
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('documents');
    }
};
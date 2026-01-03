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
        Schema::table('documents', function (Blueprint $table) {
            $table->decimal('discount_amount', 10, 2)->default(0)->after('amount');
            $table->decimal('discount_percentage', 5, 2)->default(0)->after('discount_amount');
            $table->string('discount_type')->default('none')->after('discount_percentage'); // 'none', 'fixed', 'percentage'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['discount_amount', 'discount_percentage', 'discount_type']);
        });
    }
};
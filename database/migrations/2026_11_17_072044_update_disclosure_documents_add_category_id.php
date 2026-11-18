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
    Schema::table('disclosure_documents', function (Blueprint $table) {
        // Drop the old column
        $table->dropColumn('category');

        // Add nullable() before constrained()
        $table->foreignId('disclosure_category_id')->nullable()->constrained('disclosure_categories')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disclosure_documents', function (Blueprint $table) {
            //
        });
    }
};

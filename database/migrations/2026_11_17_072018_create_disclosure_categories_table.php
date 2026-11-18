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
    Schema::create('disclosure_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // e.g., "Annual Budget"
        $table->string('description')->nullable(); // e.g., "Approved SK Fund Budget"
        $table->string('icon')->default('fa-folder-open'); // e.g., "fa-coins"
        $table->string('theme_color')->default('emerald'); // e.g., emerald, blue, amber, purple
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disclosure_categories');
    }
};

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
    Schema::create('sk_id_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Links to the registered youth

        // Personal Info
        $table->string('first_name');
        $table->string('middle_name')->nullable();
        $table->string('last_name');
        $table->string('suffix')->nullable();
        $table->date('dob');
        $table->enum('gender', ['Male', 'Female']);
        $table->string('blood_type')->nullable();

        // Contact & Location
        $table->string('address');
        $table->string('contact_number');
        $table->string('emergency_contact_name');
        $table->string('emergency_contact_number');

        // Files
        $table->string('id_photo_path'); // 2x2 picture
        $table->string('signature_path')->nullable(); // Digital signature

        // Application Tracking
        $table->enum('status', ['pending', 'approved', 'rejected', 'printed'])->default('pending');
        $table->text('remarks')->nullable(); // For rejection reasons

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_id_requests');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('assignments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');
        $table->foreignId('counselor_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};

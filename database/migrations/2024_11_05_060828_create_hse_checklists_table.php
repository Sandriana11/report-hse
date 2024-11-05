<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hse_checklists', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('reported_by')->nullable();
            $table->string('inst_dept')->nullable();
            $table->string('condition_status')->nullable();
            $table->json('ppe')->nullable();
            $table->json('working_position')->nullable();
            $table->json('ergonomic_health')->nullable();
            $table->json('tools_equipment')->nullable();
            $table->json('procedures')->nullable();
            $table->json('environment_housekeeping')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hse_checklists');
    }
};

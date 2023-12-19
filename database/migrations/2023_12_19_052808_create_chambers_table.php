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
        Schema::create('chambers', function (Blueprint $table) {
            $table->id();
            $table->string('chamber_name');
            $table->string('chamber_phone')->unique();
            $table->text('chamber_address');
            $table->text('chamber_status')->default('Inactive');
            $table->integer('chamber_delete')->default(0);
            $table->integer('chamber_created_by');
            $table->integer('chamber_updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambers');
    }
};

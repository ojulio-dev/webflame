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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->min(4);
            $table->string('username')->min(4);
            $table->string('email')->unique();
            $table->string('password', 72)->min(4);
            $table->text('description')->nullable();
            $table->string('icon')->default('default.png');
            $table->boolean('status')->default(1);
            $table->boolean('is_admin')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

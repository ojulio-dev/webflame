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
        Schema::create('reported_users', function (Blueprint $table) {
            $table->id();
            $table->tinyText('reason');
            $table->timestamp('checked_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->foreignId('reported_user_id')->references('id')->on('users');
            $table->foreignId('reporting_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reported_users', function(Blueprint $table) {

            $table->dropForeign(['reported_user_id']);
            $table->dropForeign(['reporting_user_id']);

        });

        Schema::dropIfExists('reported_users');
    }
};

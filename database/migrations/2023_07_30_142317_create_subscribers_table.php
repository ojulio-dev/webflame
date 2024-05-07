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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->foreignId('user_subscriber_id')->references('id')->on('users');
            $table->foreignId('user_channel_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscribers', function(Blueprint $table) {

            $table->dropForeign(['user_subscriber_id']);
            $table->dropForeign(['user_channel_id']);

        });

        Schema::dropIfExists('subscribers');
    }
};

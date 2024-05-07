<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Video;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reported_videos', function (Blueprint $table) {
            $table->id();
            $table->tinyText('reason');
            $table->boolean('checked')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->foreignId('reported_user_id')->references('id')->on('users');
            $table->foreignId('reporting_user_id')->references('id')->on('users');
            $table->foreignIdFor(Video::class)->references('id')->on('videos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reported_videos');
    }
};

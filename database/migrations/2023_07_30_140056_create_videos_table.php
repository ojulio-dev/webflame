<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\VideoStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title', 70);
            $table->text('description');
            $table->string('video')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->foreignIdFor(User::class)->references('id')->on('users');
            $table->foreignId('status_id')->references('id')->on('video_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function(Blueprint $table) {

            $table->dropForeignIdFor(User::class);
            $table->dropForeign(['status_id']);

        });

        Schema::dropIfExists('videos');
    }
};

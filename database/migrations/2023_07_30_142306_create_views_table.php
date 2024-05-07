<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Video;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->foreignIdFor(User::class)->references('id')->on('users');
            $table->foreignIdFor(Video::class)->references('id')->on('videos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('views', function(Blueprint $table) {

            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(Video::class);

        });

        Schema::dropIfExists('views');
    }
};

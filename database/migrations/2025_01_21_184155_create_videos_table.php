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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url');
            $table->string('thumbnail_url')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('previous')->nullable();
            $table->unsignedBigInteger('next')->nullable();

            $table->timestamps();
            $table->unsignedBigInteger('serie_id')->nullable();
            $table->foreign('serie_id')
            ->references('id')->on('series')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

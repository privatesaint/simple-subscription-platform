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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("website_id");
            $table->string("title");
            $table->string("slug");
            $table->text("content");
            $table->enum("delivery_status", ["pending", "processing", "sent"])->default("pending");
            $table->boolean("is_published")->default(true);
            $table->timestamps();

            $table->foreign('website_id')->references('id')->on('websites')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

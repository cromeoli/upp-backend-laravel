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
        Schema::create('upp', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("post_id")->unsigned();
            $table->foreign("post_id")->references("id")->on("post");
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("user");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upp');
    }
};

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
        Schema::create('post', function (Blueprint $table) {
            $table->increments("id");
            $table->string("post_content", 222);
            $table->integer("type")->unsigned();
            $table->foreign("type")->references("id")->on("type");
            $table->integer("in_heaven")->default(0);
            $table->integer("circle_id")->unsigned();
            $table->foreign("circle_id")->references("id")->on("circle");
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
        Schema::dropIfExists('post');
    }
};

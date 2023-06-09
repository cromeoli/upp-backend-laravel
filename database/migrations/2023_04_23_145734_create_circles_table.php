<?php

use App\Models\Circle;
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
        Schema::create('circle', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->string("description");
            $table->integer("creator_id")->unsigned();
            $table->foreign("creator_id")->references("id")->on("user");
            $table->integer("is_private")->default(0);
            $table->string("pass")->default("default");
            $table->timestamps();
        });

        Circle::create([
            'name' => 'Global',
            'description' => 'Global circle',
            'creator_id' => 1,
            'is_private' => 0,
            'pass' => 'default',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle');
    }
};

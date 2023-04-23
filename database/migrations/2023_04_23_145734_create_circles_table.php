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
            $table->integer("is_private");
            $table->string("pass");
            $table->timestamps();
        });

        Circle::create([
            'name' => 'Global',
            'description' => 'Global circle',
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

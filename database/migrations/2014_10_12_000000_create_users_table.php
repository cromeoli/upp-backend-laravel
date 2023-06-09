<?php

use App\Models\User;
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
        Schema::create('user', function (Blueprint $table) {
            $table->increments("id");
            $table->string('nickname', 32)->unique();
            $table->string('description', 222)->nullable();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('avatar', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'nickname' => 'CiberNinjaMaster',
            'description' => 'Ciberbohemian',
            'email' => "paco@gmail.com",
            'password' => bcrypt('toor'),
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};

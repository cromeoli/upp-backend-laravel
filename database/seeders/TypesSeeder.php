<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types=['text', 'image', 'video', 'audio'];
        foreach ($types as $type) {
            Type::create([
                'name' => $type,
            ]);
        }
    }
}

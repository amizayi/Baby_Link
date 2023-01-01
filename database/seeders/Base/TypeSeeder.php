<?php

namespace Database\Seeders\Base;

use App\Models\Base\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{ 
    public function run()
    {
        $types = [
            ['name' => 'short-link'], 
            ['name' => 'file-link']
        ];

        foreach($types as $types) {
            Type::create($types);
        }
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Base\StatusSeeder;
use Database\Seeders\Base\TypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{ 
    public function run()
    {
        $this->call([
            TypeSeeder::class,
            StatusSeeder::class,
            LinkSeeder::class,
        ]);
    }
}

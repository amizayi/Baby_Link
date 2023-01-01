<?php

namespace Database\Seeders\Base;

use App\Models\Base\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['name' => 'public'], 
            ['name' => 'private'], 
            ['name' => 'group'], 
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}

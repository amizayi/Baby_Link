<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    public function run()
    {
        $links = [
            [
                'code' => 'google',
                'redirect_url' => 'https://www.google.com',
                'type_id' => 1,
                'staus_id' => 1,
            ],
            [
                'code' => 'linkedin',
                'redirect_url' => 'https://www.linkedin.com/',
                'type_id' => 1,
                'staus_id' => 1,
            ],
            [
                'code' => 'github',
                'redirect_url' => 'https://github.com',
                'type_id' => 1,
                'staus_id' => 1,
            ],
        ];

        foreach($links as $link) {
            Link::create($link);
        }
    }
}

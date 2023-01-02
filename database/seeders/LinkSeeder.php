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
                'code' => 'linkedin',
                'redirect_url' => 'https://www.linkedin.com/in/amirreza-rezaei/',
                'type_id' => 1,
                'status_id' => 1,
            ],
            [
                'code' => 'github',
                'redirect_url' => 'https://github.com/amirrezarzyi',
                'type_id' => 1,
                'status_id' => 1,
            ],
            [
                'code' => 'twitter',
                'redirect_url' => 'https://twitter.com/AmirrezaRezae18',
                'type_id' => 1,
                'status_id' => 1,
            ],
            [
                'code' => 'facebook',
                'redirect_url' => 'https://www.facebook.com/amirrezarzyi',
                'type_id' => 1,
                'status_id' => 1,
            ],
        ];

        foreach ($links as $link) {
            Link::create($link);
        }
    }
}

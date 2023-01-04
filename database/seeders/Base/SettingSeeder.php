<?php

namespace Database\Seeders\Base;

use App\Models\Base\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{ 
    public function run()
    {
        $settings = [
            [
                'key' => 'version',
                'value' => '1.0.0'
            ],
            [
                'key' => 'code_link',
                'value' => '0'
            ],
            [
                'key' => 'file_link',
                'value' => '0'
            ],
        ];

        foreach($settings as $data) {
            Setting::create($data);
        }
    }
}

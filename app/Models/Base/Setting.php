<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'settings';

    protected $guarded = ['id'];

    public static function generateCode($type)
    {
        if ($type === 'link') {
            $currentLinkCode = self::where('key', 'code_link')->first();
            $currentLinkCode->update(['value' => (int)++$currentLinkCode->value]);
            return 'link' . $currentLinkCode->value;
        } else {
            $currentFileCode = self::where('key', 'file_link')->first();
            $currentFileCode->update(['value' => (int)++$currentFileCode->value]);
            return 'file' . $currentFileCode->value;
        }
    }
}

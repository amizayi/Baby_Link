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

    public static function generateCode()
    {
        $current = self::where('key', 'code_link')->first();
        $currentValue = $current->value;
        $current->update([
            'value' => (int)++$current->value
        ]);
        return 'link' . $currentValue;
    }
}

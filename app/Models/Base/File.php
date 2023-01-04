<?php

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'files';

    protected $guarded = ['id'];
 
    public function fileable()
    {
        return $this->morphTo();
    }

    public static function createFile($file,$link)
    {
        $carbon = Carbon::now();
        $uniqueName = $carbon->format('Ymd-') . $carbon->format('Hisu');
        $data = $link->files()->create([
            'original_name'  => $file->getClientOriginalName(),
            'mime_type'      => $file->extension(),
            'name'           => $uniqueName . '.' . $file->getClientOriginalExtension(),
            'size'           => $file->getSize(),
            'date'           => $carbon->toDateString(),
        ]);
        return $data;
    }
}

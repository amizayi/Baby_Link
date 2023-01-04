<?php

namespace App\Models;

use App\Models\Base\File;
use App\Models\Base\Setting;
use App\Models\Base\Status;
use App\Models\Base\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'links';

    protected $guarded = ['id'];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    
    public static function createLink($request, $type = 'link')
    {
        return self::query()->create([
            'redirect_url' => $request->redirect_url ?? null,
            'code'         => $request->code ?? Setting::generateCode($type), // generate code with system 
            'is_active'    => 1, // active
            'status_id'    => 1, // public
            'type_id'      => $type === 'link' ? 1 : 2, // link or file
        ]);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}

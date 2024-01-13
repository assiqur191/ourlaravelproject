<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    protected $fillable = ['avatar', 'path'];

    public function avataruser()
    {
        return $this->belongsTo(User::class,'path');
    }
}

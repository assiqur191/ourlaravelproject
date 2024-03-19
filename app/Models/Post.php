<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    use HasFactory;
    protected $fillable = ['title','body','user_id'];

    public function toSearchableArray()
    {
        return[
            'title' => $this->title,
            'body' => $this->body
        ];
    }

    public function user(){
        return $this->BelongsTo(User::class,'user_id');

    }
   
}
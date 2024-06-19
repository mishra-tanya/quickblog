<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;
    public $timestamp=false;
    protected $fillable = ['title', 'type', 'content', 'image'];
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;

        if (!$this->exists) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}

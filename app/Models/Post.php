<?php

namespace App\Models;


use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $ForeignId = 'uuid';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // protected $guarded = [];
    protected $fillable = [
        'uuid',
        'description',
        'user_id',
        'image',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }


}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $ForeignId = 'uuid';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $fillable = [
        'uuid',
        'comments',
        'user_id',
        'post_id',
        'post_uuid',
        'comments_count',
        'image',
    ];
    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }
}
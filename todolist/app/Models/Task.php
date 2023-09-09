<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'completed', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getUserTasks()
    {
        return static::where('user_id', auth()->id())->get();
    }

}

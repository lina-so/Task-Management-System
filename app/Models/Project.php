<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable  = ['name','description','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function tags()
{
    return $this->hasManyThrough(Tag::class, Task::class);
}
}

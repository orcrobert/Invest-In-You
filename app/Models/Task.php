<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'deadline', 
        'penalty'
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Task extends Model
{
    use HasFactory;
  
    protected $table = 'tasks';
    protected $fillable = ['user_id', 'title', 'description', 'deadline', 'price', 'completed'];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

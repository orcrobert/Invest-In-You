<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Task extends Model
{

    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = ['user_id', 'title', 'description', 'deadline', 'price', 'status'];
    // or declare $guarded instead

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}

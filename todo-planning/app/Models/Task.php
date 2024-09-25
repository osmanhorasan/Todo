<?php

// app/Models/Task.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'difficulty', 'provider_id'];

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id'); // Burada 'developer_id', Task modelinin geliştirici ile olan ilişkisini belirtir
    }
}

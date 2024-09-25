<?php
// app/Models/Developer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'difficulty', 'developer_id'];
    public function tasks()
    {
        return $this->hasMany(Task::class, 'developer_id'); // Burada 'developer_id', Developer modelinin görevler ile olan ilişkisini belirtir
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMaster extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'exam_date', 'exam_duration', 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_approved')
            ->withTimestamps();;
    }
}

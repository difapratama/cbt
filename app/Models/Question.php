<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['exam_id','question_text'];

    public function exam()
    {
        return $this->belongsTo(ExamMaster::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}

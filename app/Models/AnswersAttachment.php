<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswersAttachment extends Model
{
    use HasFactory;
    protected $fillable = ['answer_id', 'format'];

    
    public function answer() {
        return $this->belongsTo(Answer::class);
    }
}

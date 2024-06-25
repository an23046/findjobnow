<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'job_offer_id', 'content'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function job_offer() {
        return $this->belongsTo(JobOffer::class);
    }

    public function attachment() {
        return $this->hasOne(AnswersAttachment::class);
    }
}

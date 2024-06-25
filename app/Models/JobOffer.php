<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'category_id', 'company_name', 'description', 'salary', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}

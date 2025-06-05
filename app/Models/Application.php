<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id', 
        'job_posting_id',
        'name',
        'email',
        'phone',
        'cv',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function jobPosting() {
        return $this->belongsTo(JobPosting::class);
    }
}

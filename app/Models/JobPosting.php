<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'job_title',
        'company_name',
        'category',
        'description',
        'salary',
        'vacancy',
        'experience',
        'logo',
        'job_type',
        'requirement',
        'skill',
        'proof',
        'deadline',
        'email',
        'phone',
        'website',
        'address',
        'town',
        'facebook',
        'X',
        'linkedin',
        'instagram',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'deadline' => 'datetime',
        'skills' => 'array',
        'requirements' => 'array',
         'skills' => 'array',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // public function savedByUsers()
    // {
    //     return $this->belongsToMany(User::class, 'saved_jobs', 'job_id', 'user_id')
    //                 ->withTimestamps();
    // }


}

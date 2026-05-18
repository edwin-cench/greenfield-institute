<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    // Crucial: Allow us to save the user and course IDs when someone registers
    protected $fillable = ['user_id', 'course_id'];

    // Define the relationship: An Enrollment belongs to one Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Define the relationship: An Enrollment belongs to one User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

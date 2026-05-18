<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Allow these fields to be saved to the database
    protected $fillable = ['code', 'title', 'description', 'capacity'];

    // Define the relationship: A Course has many Enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}

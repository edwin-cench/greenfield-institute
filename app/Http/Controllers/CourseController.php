<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Handle Registration Logic
    public function register(Request $request, $course_id) {
        $course = Course::findOrFail($course_id);

        // Count how many people are currently enrolled
        $currentEnrollment = Enrollment::where('course_id', $course_id)->count();

        // Check Capacity Limit (Dynamically uses the course's set capacity)
        if ($currentEnrollment >= $course->capacity) {
            return back()->with('error', 'Sorry, this course has reached its maximum capacity.');
        }

        // Check for duplicate registrations
        $alreadyRegistered = Enrollment::where('user_id', Auth::id())
                                       ->where('course_id', $course_id)
                                       ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'You are already registered for this course.');
        }

        // Save the enrollment to the Database
        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course_id
        ]);

        return back()->with('success', "You have successfully enrolled in {$course->title}!");
    }

    // Handle Dropping a Course
    public function drop($course_id) {
        Enrollment::where('user_id', Auth::id())
                  ->where('course_id', $course_id)
                  ->delete();

        return back()->with('success', 'You have successfully dropped the course.');
    }
}

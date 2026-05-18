<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Financial;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return redirect('/login'); });
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {

    // --- STUDENT ROUTES ---
    Route::get('/dashboard', function () {
        if(Auth::user()->role === 'admin') return redirect('/admin');
        $courses = Course::withCount('enrollments')->get();
        $myEnrollments = Enrollment::where('user_id', Auth::id())->pluck('course_id')->toArray();
        return view('dashboard', compact('courses', 'myEnrollments'));
    });

    Route::get('/academics', function () {
        if(Auth::user()->role === 'admin') return redirect('/admin');
        $myCourses = Enrollment::where('user_id', Auth::id())->with('course')->get();
        $results = Result::where('user_id', Auth::id())->get();
        return view('academics', compact('myCourses', 'results'));
    });

    Route::get('/financials', function () {
        if(Auth::user()->role === 'admin') return redirect('/admin');
        $transactions = Financial::where('user_id', Auth::id())->get();
        $balance = $transactions->where('type', 'invoice')->sum('amount') - $transactions->where('type', 'payment')->sum('amount');
        return view('financials', compact('transactions', 'balance'));
    });

    Route::post('/register-course/{id}', [CourseController::class, 'register']);
    Route::post('/drop-course/{id}', [CourseController::class, 'drop']);

    // --- ADMIN ROUTES ---
    // 1. Course Management Tab
    Route::get('/admin', function () {
        if(Auth::user()->role !== 'admin') return redirect('/dashboard');
        $courses = Course::withCount('enrollments')->get();
        return view('admin', compact('courses'));
    });
    Route::post('/admin/add-course', function (Request $request) {
        Course::create($request->all());
        return back()->with('success', 'Course added successfully!');
    });
    Route::post('/admin/remove-course/{id}', function ($id) {
        Course::destroy($id);
        return back()->with('success', 'Course removed permanently.');
    });

    // 2. Student Management Tab (NEW)
    Route::get('/admin/students', function () {
        if(Auth::user()->role !== 'admin') return redirect('/dashboard');
        // Fetch all students and their enrolled courses
        $students = User::where('role', 'student')->with('enrollments.course')->get();
        return view('admin-students', compact('students'));
    });

    // Admin Actions
    Route::post('/admin/grade/{user_id}', function (Request $request, $user_id) {
        Result::updateOrCreate(
            ['user_id' => $user_id, 'course_id' => $request->course_id],
            ['grade' => $request->grade]
        );
        return back()->with('success', 'Grade posted successfully!');
    });

    Route::post('/admin/bill/{user_id}', function (Request $request, $user_id) {
        Financial::create(['user_id' => $user_id, 'description' => $request->description, 'amount' => $request->amount, 'type' => $request->type]);
        return back()->with('success', 'Financial record applied!');
    });

    Route::post('/admin/promote/{user_id}', function ($user_id) {
        User::where('id', $user_id)->update(['role' => 'admin']);
        return back()->with('success', 'User promoted to Admin!');
    });
});

// --- SETUP BACKDOOR ---
Route::get('/setup', function () {
    User::firstOrCreate(['email' => 'admin@greenfield.com'], ['name' => 'System Admin', 'password' => bcrypt('admin123'), 'role' => 'admin', 'reg_number' => 'GF-ADMIN-01']);
    $student = User::firstOrCreate(['email' => 'student@greenfield.com'], ['name' => 'Test Student', 'password' => bcrypt('password123'), 'role' => 'student', 'reg_number' => 'GF-2026-0001']);

    $c1 = Course::firstOrCreate(['code' => 'CSC101'], ['title' => 'Intro to Programming', 'lecturer_name' => 'Dr. Alan Turing', 'description' => 'Learn basic coding logic.', 'capacity' => 5]);
    $c2 = Course::firstOrCreate(['code' => 'CSC201'], ['title' => 'Data Structures', 'lecturer_name' => 'Dr. Grace Hopper', 'description' => 'Advanced data management.', 'capacity' => 5]);
    $c3 = Course::firstOrCreate(['code' => 'CSC301'], ['title' => 'Cyber Security', 'lecturer_name' => 'Dr. Kevin Mitnick', 'description' => 'Network defense & hacking.', 'capacity' => 5]);

    Financial::firstOrCreate(['user_id' => $student->id, 'description' => 'Fall Semester Tuition'], ['amount' => 2500.00, 'type' => 'invoice']);
    Result::firstOrCreate(['user_id' => $student->id, 'course_id' => $c1->id], ['grade' => 'A-']);

    return "Setup Complete! <br>Admin: admin@greenfield.com / admin123 <br>Student: student@greenfield.com / password123 <br><a href='/login'>Go to Login</a>";
});

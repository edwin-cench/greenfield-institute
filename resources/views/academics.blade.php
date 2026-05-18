@extends('layouts.app')

@section('content')
<div class="bg-slate-800 rounded-xl p-6 shadow-md border border-slate-600 mb-8">
    <h1 class="text-3xl font-bold text-white mb-2">Academics & Results</h1>
    <p class="text-slate-400 text-sm">
        Review your current enrollments, track your academic progress, and access your official transcripts. Grades are updated automatically by your lecturers at the end of each grading period.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="bg-slate-700 rounded-xl p-6 shadow-md border border-slate-600">
        <h2 class="text-xl font-bold text-white mb-4">My Current Courses</h2>

        @if($myCourses->isEmpty())
            <p class="text-slate-400 text-sm">You are not enrolled in any courses yet. Go to the Dashboard to register!</p>
        @else
            <ul class="space-y-3">
                @foreach($myCourses as $enrollment)
                    <li class="bg-slate-800 p-4 rounded flex flex-col border border-slate-600">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-indigo-400 font-bold text-sm">{{ $enrollment->course->code }}</span>
                            <span class="text-xs text-slate-400">Lecturer: {{ $enrollment->course->lecturer_name }}</span>
                        </div>
                        <span class="text-white font-medium">{{ $enrollment->course->title }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="bg-slate-700 rounded-xl p-6 shadow-md border border-slate-600">
        <h2 class="text-xl font-bold text-white mb-4">Official Transcripts</h2>

        @if($results->isEmpty())
            <p class="text-slate-400 text-sm">No grades have been posted yet.</p>
        @else
            <ul class="space-y-3">
                @foreach($results as $result)
                    <li class="bg-slate-800 p-4 rounded flex justify-between items-center border border-slate-600">
                        <span class="text-slate-300">Course ID: {{ $result->course_id }}</span>
                        <span class="text-emerald-400 font-bold text-lg bg-emerald-900/30 px-3 py-1 rounded">Grade: {{ $result->grade }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection

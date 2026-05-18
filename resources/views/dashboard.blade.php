@extends('layouts.app')

@section('content')
<div class="bg-indigo-900/40 rounded-xl p-6 shadow-md border border-indigo-500/50 mb-8">
    <h1 class="text-3xl font-bold text-white mb-2">Student Dashboard</h1>
    <p class="text-indigo-200 mb-6 text-sm">
        Welcome to your portal. Here you can browse the active catalog, view lecturer assignments, and manage your course registrations for the upcoming semester.
    </p>

    <div class="bg-slate-800/80 p-5 rounded-lg border border-slate-600 text-sm text-slate-300 leading-relaxed shadow-inner">
        <h3 class="text-indigo-400 font-bold mb-2 uppercase tracking-wide text-xs">About Greenfield Institute</h3>
        <p>
            Founded in 1998, Greenfield Institute began with a simple mission: to bridge the gap between theoretical computer science and real-world software engineering. Over the past two decades, we have grown from a small basement lab into a premier technology institute, empowering thousands of students to innovate, build, and lead in the digital age. Your journey starts here.
        </p>
    </div>
</div>

<h2 class="text-xl font-semibold text-indigo-400 mb-4">Available Courses</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($courses as $course)
        <div class="bg-slate-700 rounded-xl p-6 shadow-md border border-slate-600">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold bg-indigo-900 text-indigo-300 px-2 py-1 rounded">{{ $course->code }}</span>
                <span class="text-sm font-medium {{ $course->enrollments_count >= $course->capacity ? 'text-red-400' : 'text-slate-400' }}">
                    👥 {{ $course->enrollments_count }} / {{ $course->capacity }}
                </span>
            </div>
            <h3 class="text-lg font-bold text-white mb-1">{{ $course->title }}</h3>
            <p class="text-xs text-indigo-300 mb-2">Lecturer: {{ $course->lecturer_name }}</p>
            <p class="text-sm text-slate-400 mb-6 h-12 overflow-hidden">{{ $course->description }}</p>

            @if(in_array($course->id, $myEnrollments))
                <form action="/drop-course/{{ $course->id }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-red-400 border border-red-500 hover:bg-red-500 hover:text-white py-2 rounded transition">Drop Course</button>
                </form>
            @elseif($course->enrollments_count >= $course->capacity)
                <button disabled class="w-full bg-slate-600 text-slate-400 py-2 rounded cursor-not-allowed">Course Full</button>
            @else
                <form action="/register-course/{{ $course->id }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white py-2 rounded transition shadow-lg">Enroll</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="bg-slate-800 rounded-xl p-6 shadow-md border border-slate-600 mb-8">
    <h1 class="text-3xl font-bold text-white mb-2">Admin Control Panel</h1>
    <p class="text-slate-400 text-sm">
        Use this secure interface to manage the Greenfield Institute course catalog. You can open new courses for registration, assign lecturers, and strictly manage maximum student capacities across the system.
    </p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1">
        <div class="bg-slate-700 rounded-xl p-6 shadow-md border border-slate-600">
            <h2 class="text-xl font-bold text-white mb-4">Add New Course</h2>
            <form action="/admin/add-course" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Course Code</label>
                    <input type="text" name="code" required placeholder="e.g. CSC400" class="w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded text-white focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Course Title</label>
                    <input type="text" name="title" required placeholder="e.g. Artificial Intelligence" class="w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded text-white focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Lecturer Name</label>
                    <input type="text" name="lecturer_name" required placeholder="Dr. John Doe" class="w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded text-white focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Description</label>
                    <textarea name="description" rows="2" class="w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded text-white focus:outline-none focus:border-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Max Capacity</label>
                    <input type="number" name="capacity" value="5" required class="w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded text-white focus:outline-none focus:border-indigo-500">
                </div>
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 rounded transition">Create Course</button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-slate-700 rounded-xl p-6 shadow-md border border-slate-600">
            <h2 class="text-xl font-bold text-white mb-4">Manage Course Catalog</h2>
            <div class="space-y-4">
                @foreach($courses as $course)
                    <div class="bg-slate-800 p-4 rounded border border-slate-600 flex justify-between items-center">
                        <div>
                            <div class="flex items-center mb-1">
                                <span class="bg-indigo-900 text-indigo-300 text-xs font-bold px-2 py-1 rounded mr-3">{{ $course->code }}</span>
                                <span class="text-white font-bold">{{ $course->title }}</span>
                            </div>
                            <div class="text-xs text-slate-400">
                                Enrolled: {{ $course->enrollments_count }} / {{ $course->capacity }} | Lecturer: {{ $course->lecturer_name }}
                            </div>
                        </div>
                        <form action="/admin/remove-course/{{ $course->id }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this course?');">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300 bg-red-900/30 hover:bg-red-900/50 px-3 py-2 rounded text-sm font-medium transition">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

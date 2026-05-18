@extends('layouts.app')

@section('content')
<div class="bg-slate-800 rounded-xl p-6 shadow-md border border-slate-600 mb-8">
    <h1 class="text-3xl font-bold text-white mb-2">Student Management</h1>
    <p class="text-slate-400 text-sm">Post official grades, update financial ledgers, and manage user permissions.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($students as $student)
        <div class="bg-slate-700 rounded-xl p-6 shadow-md border border-slate-600">
            <div class="flex justify-between items-start mb-4 border-b border-slate-600 pb-4">
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $student->name }}</h2>
                    <p class="text-indigo-400 text-sm font-mono">{{ $student->reg_number ?? 'No Reg Number' }}</p>
                    <p class="text-slate-400 text-xs">{{ $student->email }}</p>
                </div>
                <form action="/admin/promote/{{ $student->id }}" method="POST" onsubmit="return confirm('Promote this student to Admin?');">
                    @csrf
                    <button type="submit" class="bg-indigo-900/50 text-indigo-300 hover:bg-indigo-600 hover:text-white px-3 py-1 rounded text-xs font-bold transition">Make Admin</button>
                </form>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                <div class="bg-slate-800 p-4 rounded border border-slate-600">
                    <h3 class="text-sm font-bold text-emerald-400 mb-3">Post Course Grade</h3>
                    <form action="/admin/grade/{{ $student->id }}" method="POST" class="space-y-2">
                        @csrf
                        <select name="course_id" required class="w-full text-xs px-2 py-1.5 bg-slate-700 border border-slate-600 rounded text-white">
                            <option value="">Select Enrolled Course...</option>
                            @foreach($student->enrollments as $enrollment)
                                <option value="{{ $enrollment->course->id }}">{{ $enrollment->course->code }} - {{ $enrollment->course->title }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="grade" required placeholder="Grade (e.g. A, B+)" class="w-full text-xs px-2 py-1.5 bg-slate-700 border border-slate-600 rounded text-white">
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold py-1.5 rounded">Submit Grade</button>
                    </form>
                </div>

                <div class="bg-slate-800 p-4 rounded border border-slate-600">
                    <h3 class="text-sm font-bold text-red-400 mb-3">Update Financials</h3>
                    <form action="/admin/bill/{{ $student->id }}" method="POST" class="space-y-2">
                        @csrf
                        <input type="text" name="description" required placeholder="Description (e.g. Lab Fee)" class="w-full text-xs px-2 py-1.5 bg-slate-700 border border-slate-600 rounded text-white">
                        <div class="flex space-x-2">
                            <input type="number" step="0.01" name="amount" required placeholder="Amount $" class="w-1/2 text-xs px-2 py-1.5 bg-slate-700 border border-slate-600 rounded text-white">
                            <select name="type" required class="w-1/2 text-xs px-2 py-1.5 bg-slate-700 border border-slate-600 rounded text-white">
                                <option value="invoice">Charge</option>
                                <option value="payment">Payment</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-500 text-white text-xs font-bold py-1.5 rounded">Add Record</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

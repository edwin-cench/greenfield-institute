@extends('layouts.app')

@section('content')
<div class="bg-slate-800 rounded-xl p-6 shadow-md border border-slate-600 mb-8">
    <h1 class="text-3xl font-bold text-white mb-2">Financial Account</h1>
    <p class="text-slate-400 text-sm">
        Manage your tuition invoices, track recent payments, and monitor your current balance. Please ensure all outstanding balances are settled prior to the final exam period to avoid academic holds.
    </p>
</div>

<div class="bg-indigo-900 rounded-xl p-6 shadow-md border border-indigo-500 mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-indigo-200 text-sm font-bold uppercase tracking-wider mb-1">Current Balance Due</h2>
        <p class="text-slate-300 text-sm">Please pay your balance before the semester ends.</p>
    </div>
    <div class="text-4xl font-extrabold {{ $balance > 0 ? 'text-red-400' : 'text-emerald-400' }}">
        ${{ number_format($balance, 2) }}
    </div>
</div>

<div class="bg-slate-700 rounded-xl shadow-md border border-slate-600 overflow-hidden">
    <table class="w-full text-left text-sm text-slate-300">
        <thead class="bg-slate-800 text-slate-100 uppercase text-xs">
            <tr>
                <th class="px-6 py-4 border-b border-slate-600">Date</th>
                <th class="px-6 py-4 border-b border-slate-600">Description</th>
                <th class="px-6 py-4 border-b border-slate-600">Type</th>
                <th class="px-6 py-4 border-b border-slate-600 text-right">Amount</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-600">
            @forelse($transactions as $tx)
                <tr class="hover:bg-slate-600 transition-colors">
                    <td class="px-6 py-4">{{ $tx->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 font-medium text-white">{{ $tx->description }}</td>
                    <td class="px-6 py-4">
                        @if($tx->type === 'invoice')
                            <span class="bg-red-900/50 text-red-300 px-2 py-1 rounded text-xs font-bold uppercase">Charge</span>
                        @else
                            <span class="bg-emerald-900/50 text-emerald-300 px-2 py-1 rounded text-xs font-bold uppercase">Payment</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right font-bold {{ $tx->type === 'invoice' ? 'text-red-400' : 'text-emerald-400' }}">
                        ${{ number_format($tx->amount, 2) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-slate-400">No financial records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

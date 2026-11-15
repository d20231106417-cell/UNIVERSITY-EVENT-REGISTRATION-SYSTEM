@extends('layouts.app')

@section('title', 'Student dashboard')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div><p class="text-sm font-semibold text-blue-700">STUDENT PORTAL</p><h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Welcome, {{ auth()->user()->name }}</h1><p class="mt-2 text-sm text-slate-500">Your campus event activity at a glance.</p></div>
    <span class="inline-flex w-fit items-center gap-2 rounded-full bg-blue-50 px-3.5 py-2 text-sm font-semibold text-blue-800"><span class="h-2 w-2 rounded-full bg-blue-500"></span> Student account</span>
</div>

<section class="student-banner relative overflow-hidden rounded-3xl p-6 text-white sm:p-8 lg:p-10"><div class="relative z-10 max-w-xl"><p class="text-xs font-bold tracking-[.16em] text-cyan-200">MAKE THE MOST OF CAMPUS</p><h2 class="mt-3 text-2xl font-bold tracking-tight sm:text-3xl">There’s always something happening.</h2><p class="mt-3 max-w-lg text-sm leading-6 text-blue-100/80">Your registrations and their latest status will appear here.</p></div><div class="banner-orbit" aria-hidden="true"><span></span><i></i><b></b></div></section>

<section class="mt-8 grid gap-4 sm:grid-cols-3">
    @foreach ([['label' => 'Total registrations', 'value' => $registrationCounts->sum(), 'symbol' => '▤', 'tone' => 'blue'], ['label' => 'Pending', 'value' => $registrationCounts->get('Pending', 0), 'symbol' => '◷', 'tone' => 'amber'], ['label' => 'Approved', 'value' => $registrationCounts->get('Approved', 0), 'symbol' => '✓', 'tone' => 'emerald']] as $stat)
        <article class="stat-card"><div class="flex items-start justify-between"><p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p><span class="stat-icon stat-icon-{{ $stat['tone'] }}">{{ $stat['symbol'] }}</span></div><p class="mt-5 text-3xl font-bold tracking-tight text-slate-900">{{ $stat['value'] }}</p></article>
    @endforeach
</section>

<section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm shadow-slate-900/[.02]">
    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-5 sm:px-7"><div><h2 class="font-bold text-slate-900">Recent registrations</h2><p class="mt-1 text-sm text-slate-500">A quick look at your event requests.</p></div><span class="hidden rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500 sm:inline-flex">{{ $recentRegistrations->count() }} shown</span></div>
    @if ($recentRegistrations->isEmpty())
        <div class="px-6 py-14 text-center"><span class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-xl text-blue-700" aria-hidden="true">✦</span><h3 class="mt-4 font-semibold text-slate-800">Your activity will show up here</h3><p class="mx-auto mt-1 max-w-sm text-sm leading-6 text-slate-500">Once you have event registrations, you’ll be able to track their status from this dashboard.</p></div>
    @else
        <div class="overflow-x-auto"><table class="min-w-full text-left text-sm"><thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-6 py-3 font-semibold">Event</th><th class="px-6 py-3 font-semibold">Registered</th><th class="px-6 py-3 font-semibold">Status</th></tr></thead><tbody class="divide-y divide-slate-100">
            @foreach ($recentRegistrations as $registration)
                <tr><td class="px-6 py-4 font-semibold text-slate-800">{{ $registration->event_name }}</td><td class="px-6 py-4 text-slate-500">{{ $registration->registration_date->format('d M Y') }}</td><td class="px-6 py-4"><span @class(['status-pill', 'status-pending' => $registration->status === 'Pending', 'status-approved' => $registration->status === 'Approved', 'status-rejected' => $registration->status === 'Rejected'])>{{ $registration->status }}</span></td></tr>
            @endforeach
        </tbody></table></div>
    @endif
</section>
@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') · UniVents</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    @php($homeRoute = auth()->user()->role === 'admin' ? 'admin.home' : 'student.home')
    <aside class="fixed inset-y-0 left-0 z-20 hidden w-64 flex-col bg-[#102b53] px-5 py-7 text-white lg:flex">
        <a href="{{ route($homeRoute) }}" class="flex items-center gap-3 px-2">
            <span class="brand-logo-wrap"><img src="{{ asset('images/univents-logo.png') }}" alt="UniVents"></span>
            <span><span class="block text-lg font-bold tracking-tight">UniVents</span><span class="block text-xs text-blue-200">Campus event portal</span></span>
        </a>
        <div class="mt-12 px-3 text-[11px] font-bold uppercase tracking-[.18em] text-blue-300">Workspace</div>
        <nav class="mt-3 flex flex-col gap-1">
            <a href="{{ route($homeRoute) }}" class="flex items-center gap-3 rounded-xl bg-white/12 px-3 py-3 text-sm font-semibold text-white"><span class="nav-icon" aria-hidden="true">⌂</span> Dashboard</a>
        </nav>
        <div class="mt-auto rounded-2xl border border-white/10 bg-white/5 p-4">
            <p class="text-xs font-semibold text-blue-200">SIGNED IN AS</p>
            <p class="mt-2 truncate text-sm font-semibold">{{ auth()->user()->name }}</p>
            <p class="mt-1 text-xs capitalize text-blue-200">{{ auth()->user()->role }} account</p>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left text-sm font-medium text-blue-100 transition hover:bg-white/10 hover:text-white"><span aria-hidden="true">↪</span> Log out</button>
        </form>
    </aside>

    <div class="lg:pl-64">
        <header class="flex h-20 items-center justify-between border-b border-slate-200 bg-white px-5 sm:px-8 lg:px-10">
            <a href="{{ route($homeRoute) }}" class="flex items-center gap-3 lg:hidden"><span class="brand-logo-wrap"><img src="{{ asset('images/univents-logo.png') }}" alt="UniVents"></span><span class="font-bold tracking-tight text-[#102b53]">UniVents</span></a>
            <div class="hidden text-sm text-slate-500 sm:block">University event registration</div>
            <div class="ml-auto flex items-center gap-4">
                <span class="hidden text-right sm:block"><span class="block text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</span><span class="block text-xs capitalize text-slate-500">{{ auth()->user()->role }}</span></span>
                <span class="avatar-chip" aria-hidden="true">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                <form method="POST" action="{{ route('logout') }}" class="lg:hidden">@csrf<button class="text-sm font-semibold text-blue-800" type="submit">Log out</button></form>
            </div>
        </header>
        <main class="mx-auto max-w-7xl px-5 py-8 sm:px-8 lg:px-10 lg:py-10">
            @if (session('status'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="status">{{ session('status') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
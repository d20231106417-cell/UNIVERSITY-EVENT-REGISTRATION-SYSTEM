<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route(match (Auth::user()->role) {
            'student' => 'student.home',
            'admin' => 'admin.home',
            default => abort(403),
        });
    }

    public function student(): View
    {
        /** @var User $student */
        $student = Auth::user();

        $registrationCounts = $student->eventRegistrations()
            ->selectRaw('status, COUNT(*) AS aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $recentRegistrations = $student->eventRegistrations()
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboards.student', [
            'registrationCounts' => $registrationCounts,
            'recentRegistrations' => $recentRegistrations,
        ]);
    }

    public function admin(): View
    {
        $studentCount = User::query()->where('role', 'student')->count();
        $registrationCount = EventRegistration::query()->count();
        $pendingCount = EventRegistration::query()->where('status', 'Pending')->count();

        $recentRegistrations = EventRegistration::query()
            ->with('student')
            ->latest()
            ->limit(6)
            ->get();

        return view('dashboards.admin', [
            'studentCount' => $studentCount,
            'registrationCount' => $registrationCount,
            'pendingCount' => $pendingCount,
            'recentRegistrations' => $recentRegistrations,
        ]);
    }
}

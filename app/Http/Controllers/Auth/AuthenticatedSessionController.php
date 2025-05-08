<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Set is_active = 1 if the logged-in user is a doctor
        if ($user->hasRole('doctor')) {
            $user->is_active = 1;
            $user->save();
        }

        return $this->redirectToDashboard($user);
    }

    /**
     * Redirect user to dashboard based on role.
     */
    private function redirectToDashboard($user): RedirectResponse
    {
        $role = $user->getRoleNames()->first(); // gets the first assigned role

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.index');
            case 'pregnant-woman':
                return redirect()->route('pregnant.index');
            case 'doctor':
                return redirect()->route('doctor.index');
            case 'breastfeeding-woman':
                return redirect()->route('breastfeeding.index');
            case 'organisation':
                return redirect()->route('organisation.index');
            default:
                return redirect('/login'); // fallback
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // ✅ Set is_active = 0 if the user is a doctor
        if ($user && $user->hasRole('doctor')) {
            $user->is_active = 0;
            $user->save();
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

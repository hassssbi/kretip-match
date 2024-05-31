<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        switch ($user->role_id) {
            case 1:
                return '/admin/home'; // Admin Dashboard
            case 2:
                return '/moderator/home'; // Moderator Dashboard
            case 3:
                return '/volunteer/home'; // Volunteer Dashboard
            default:
                return '/home'; // Default home page or handle unknown roles
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $request->session()->flash('success', 'You have successfully logged in!');
        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Add success message to session
        $request->session()->flash('success', 'You have successfully logged out!');

        return redirect('/');
    }
}

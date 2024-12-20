<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /* public function index()
    {
        $acount = User::admins()->count();
        $mcount = User::moderators()->count();
        $vcount = User::volunteers()->count();
        $year = Carbon::now()->year;

        $newMembers = User::latest()->take(3)->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admins.index')],
            ['name' => 'Dashboard', 'url' => route('admins.index')]
        ];
        return view('admins.index', compact('breadcrumbs', 'acount', 'mcount', 'vcount', 'year', 'newMembers'));
    } */

    public function index()
    {
        $acount = User::admins()->count();
        $mcount = User::moderators()->count();
        $vcount = User::volunteers()->count();
        $year = Carbon::now()->year;

        // Retrieve the number of registrations per month for the current year
        $registrationsPerMonth = User::volunteers()->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->all();

        // Format the data to ensure each month is represented, even if there are no registrations
        $registrationsData = array_fill(1, 12, 0);
        foreach ($registrationsPerMonth as $month => $count) {
            $registrationsData[$month] = $count;
        }

        $newMembers = User::latest()->take(3)->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admins.index')],
            ['name' => 'Dashboard', 'url' => route('admins.index')]
        ];

        return view('admins.index', compact('breadcrumbs', 'acount', 'mcount', 'vcount', 'year', 'newMembers', 'registrationsData'));
    }


    public function users()
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admins.index')],
            ['name' => 'Manage Users', 'url' => route('admins.users')]
        ];

        $users = User::all();

        return view('admins.users.users', compact('breadcrumbs', 'users'));
    }

    public function userProfile(User $user)
    {
        $roles = Role::all();
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admins.index')],
            ['name' => 'Manage Users', 'url' => route('admins.users')],
            ['name' => 'User Profile', 'url' => route('admins.userProfile', $user->id)],
        ];
        return view('admins.users.userProfile', compact('breadcrumbs', 'user', 'roles'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role_id' => ['required', 'integer', 'in:1,2,3'],
        ]);

        $user->role_id = $validatedData['role_id'];
        $user->save();

        return redirect()->route('admins.userProfile', $user->id)->with('success', 'User role updated successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the student
        $user->delete();

        // Reset the auto-increment value
        $maxId = \DB::table('users')->max('id') + 1;

        // Check if the table is empty. If it is, reset the auto-increment to 1
        if ($maxId == 1) {
            \DB::statement("ALTER TABLE users AUTO_INCREMENT = 1");
        } else {
            \DB::statement("ALTER TABLE users AUTO_INCREMENT = $maxId");
        }

        // Redirect with success message
        return redirect()->route('admins.users')->with('success', 'User deleted successfully!');
    }

    public function registrations()
    {
        $currentYear = Carbon::now()->year;
        return $this->registrationsByYear($currentYear);
    }

    public function registrationsByYear($year)
    {
        $registrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $registrationData = [];
        for ($i = 1; $i <= 12; $i++) {
            $registrationData[$i] = $registrations[$i] ?? 0;
        }

        $acount = User::admins()->count();
        $mcount = User::moderators()->count();
        $vcount = User::volunteers()->count();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admins.index')],
            ['name' => 'Dashboard', 'url' => route('admins.index')]
        ];

        return view('admins.index', [
            'registrationData' => $registrationData,
            'year' => $year,
        ], compact('acount', 'mcount', 'vcount', 'breadcrumbs'));
    }
}

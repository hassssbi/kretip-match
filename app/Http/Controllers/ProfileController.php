<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => getRoleBasedRoute($user->role_id, 'index', $user->id)],
            ['name' => 'Profile', 'url' => getRoleBasedRoute($user->role_id, 'profile', $user->id)],
        ];
        return view('profiles.index', compact('user', 'breadcrumbs'));
    }

    public function edit(User $user)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => getRoleBasedRoute($user->role_id, 'index', $user->id)],
            ['name' => 'Profile', 'url' => getRoleBasedRoute($user->role_id, 'profile', $user->id)],
            ['name' => 'Edit Profile', 'url' => getRoleBasedRoute($user->role_id, 'editProfile', $user->id)],
        ];
        return view('profiles.edit', compact('user', 'breadcrumbs'));
    }

    public function update(Request $request, User $user)
    {
        // dump($request);
        // die();
        $validatedData = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255'],
            'icno'         => ['required', 'string', 'max:255'],
            'gender'       => ['required', 'string', 'max:10'],
            'dob'          => ['required', 'date'],
            'phone_number' => ['required', 'string', 'max:20'],
            'address'      => ['required', 'string', 'max:255'],
            'state'        => ['required', 'string', 'max:255'],
            'postcode'     => ['required', 'string', 'max:10'],
            'about'        => ['nullable', 'string'],
        ]);

        // $student->update($request->all());

        $user->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'icno'         => $request->icno,
            'gender'       => $request->gender,
            'dob'          => $request->dob,
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
            'state'        => $request->state,
            'postcode'     => $request->postcode,
            'about'        => $request->about,
        ]);


        // Determine the redirect URL based on the user's role
        $redirectUrl = getRoleBasedRoute($user->role_id, 'profile', $user->id);

        // Redirect to the respective dashboard with a success message
        return redirect($redirectUrl)->with('success', 'Profile updated successfully!');
    }

    public function changePassword(User $user)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => getRoleBasedRoute($user->role_id, 'index', $user->id)],
            ['name' => 'Profile', 'url' => getRoleBasedRoute($user->role_id, 'profile', $user->id)],
            ['name' => 'Change Password', 'url' => getRoleBasedRoute($user->role_id, 'changePassword', $user->id)],
        ];
        return view('profiles.changePassword', compact('breadcrumbs', 'user'));
    }

    public function savePassword(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Determine the redirect URL based on the user's role
        $redirectUrl = getRoleBasedRoute($user->role_id, 'profile', $user->id);

        // Redirect to the respective dashboard with a success message
        return redirect($redirectUrl)->with('success', 'Password updated successfully!');
    }
}

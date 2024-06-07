<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $breadcrumbs = [
            ['name' => 'Home', 'url' => getRoleBasedRoute($user->role_id, 'index', $user->id)],
            ['name' => 'Profile', 'url' => getRoleBasedRoute($user->role_id, 'profile', $user->id)],
        ];
        $user->load('skills'); // Eager load the skills relationship

        // Create a comma-separated string of skills
        $skills = $user->skills->implode('name', ', ');

        return view('profiles.index', compact('user', 'breadcrumbs', 'skills'));
    }

    public function edit()
    {
        $user = auth()->user();
        $breadcrumbs = [
            ['name' => 'Home', 'url' => getRoleBasedRoute($user->role_id, 'index', $user->id)],
            ['name' => 'Profile', 'url' => getRoleBasedRoute($user->role_id, 'profile', $user->id)],
            ['name' => 'Edit Profile', 'url' => getRoleBasedRoute($user->role_id, 'editProfile', $user->id)],
        ];
        return view('profiles.edit', compact('user', 'breadcrumbs'));
    }

    /* public function update(Request $request)
    {
        $user = auth()->user();
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
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image) {
                Storage::delete('public/profile_images/'.$user->image);
            }

            // Upload the new image
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/profile_images', $imageName);

            // Add the image name to the validated data array
            $validatedData['image'] = "profile_images/$imageName";
        }

        // Update the user with the validated data
        $user->update($validatedData);

        // Determine the redirect URL based on the user's role
        $redirectUrl = getRoleBasedRoute($user->role_id, 'profile', $user->id);

        // Redirect to the respective dashboard with a success message
        return redirect($redirectUrl)->with('success', 'Profile updated successfully!');
    } */

    public function update(Request $request)
    {
        $user = auth()->user();

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
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'skills'       => ['nullable', 'array'],
            'skills.*'     => ['nullable', 'string'],
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/profile_images', $imageName);
            $validatedData['image'] = "profile_images/$imageName";
        }

        // Update the user with the validated data
        $user->update($validatedData);

        // Sync the skills
        $skills = collect($request->input('skills', []))->filter()->map(function ($skill) {
            return Skill::firstOrCreate(['name' => $skill, 'description' => $skill])->id;
        });

        // Sync the user's skills with the provided skill IDs
        $user->skills()->sync($skills);

        // Determine the redirect URL based on the user's role
        $redirectUrl = getRoleBasedRoute($user->role_id, 'profile', $user->id);

        // Redirect to the respective dashboard with a success message
        return redirect($redirectUrl)->with('success', 'Profile updated successfully!');
    }


    public function changePassword()
    {
        $user = auth()->user();
        $breadcrumbs = [
            ['name' => 'Home', 'url' => getRoleBasedRoute($user->role_id, 'index', $user->id)],
            ['name' => 'Profile', 'url' => getRoleBasedRoute($user->role_id, 'profile', $user->id)],
            ['name' => 'Change Password', 'url' => getRoleBasedRoute($user->role_id, 'changePassword', $user->id)],
        ];
        return view('profiles.changePassword', compact('breadcrumbs', 'user'));
    }

    public function savePassword(Request $request)
    {
        $user = auth()->user();
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

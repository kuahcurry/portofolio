<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $profile = Profile::firstOrCreate([], [
            'name' => 'Alexander Vance',
            'title' => 'Software Engineer',
            'tagline' => 'Architecting resilient software.',
            'bio' => 'Engineering biography...',
            'email' => 'contact@example.com',
            'availability_status' => 'Available for projects',
            'years_of_experience' => 5,
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'tagline' => 'required|string|max:255',
            'tagline_id' => 'nullable|string|max:255',
            'bio' => 'required|string',
            'bio_id' => 'nullable|string',
            'short_bio' => 'nullable|string',
            'avatar' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:100',
            'github_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'resume_url' => 'nullable|string|max:255',
            'availability_status' => 'required|string|max:255',
            'years_of_experience' => 'required|integer|min:0|max:100',
        ]);

        $profile = Profile::first();
        if ($profile) {
            $profile->update($validated);
        } else {
            Profile::create($validated);
        }

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profile and Bio information updated successfully.');
    }

    public function updateAccount(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('account_success', 'Admin login credentials updated successfully.');
    }
}

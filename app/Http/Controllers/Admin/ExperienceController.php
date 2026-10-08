<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::orderBy('sort_order')->latest('start_date')->get();

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create(): View
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'role' => 'required|string|max:255',
            'role_id' => 'nullable|string|max:255',
            'company' => 'required|string|max:255',
            'company_url' => 'nullable|url|max:255',
            'certificate_url' => 'nullable|url|max:255',
            'certificate_image' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|string|max:100',
            'end_date' => 'nullable|string|max:100',
            'is_current' => 'nullable|boolean',
            'description' => 'nullable|string',
            'description_id' => 'nullable|string',
            'highlights' => 'nullable|string',
            'highlights_id' => 'nullable|string',
            'technologies' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['end_date'] = $validated['is_current'] ? 'Present' : ($validated['end_date'] ?? 'Present');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (! empty($validated['highlights'])) {
            $validated['highlights'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $validated['highlights'])))));
        } else {
            $validated['highlights'] = [];
        }

        if (! empty($validated['highlights_id'])) {
            $validated['highlights_id'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $validated['highlights_id'])))));
        } else {
            $validated['highlights_id'] = [];
        }

        if (! empty($validated['technologies'])) {
            $validated['technologies'] = array_values(array_filter(array_map('trim', explode(',', $validated['technologies']))));
        } else {
            $validated['technologies'] = [];
        }

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience record created successfully.');
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'role' => 'required|string|max:255',
            'role_id' => 'nullable|string|max:255',
            'company' => 'required|string|max:255',
            'company_url' => 'nullable|url|max:255',
            'certificate_url' => 'nullable|url|max:255',
            'certificate_image' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|string|max:100',
            'end_date' => 'nullable|string|max:100',
            'is_current' => 'nullable|boolean',
            'description' => 'nullable|string',
            'description_id' => 'nullable|string',
            'highlights' => 'nullable|string',
            'highlights_id' => 'nullable|string',
            'technologies' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['end_date'] = $validated['is_current'] ? 'Present' : ($validated['end_date'] ?? 'Present');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (isset($validated['highlights'])) {
            $validated['highlights'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $validated['highlights'])))));
        }

        if (isset($validated['highlights_id'])) {
            $validated['highlights_id'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $validated['highlights_id'])))));
        }

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_values(array_filter(array_map('trim', explode(',', $validated['technologies']))));
        }

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience record updated successfully.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience record deleted successfully.');
    }
}

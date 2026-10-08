<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        $education = Education::orderBy('sort_order')->latest('start_year')->get();

        return view('admin.education.index', compact('education'));
    }

    public function create(): View
    {
        return view('admin.education.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'degree_id' => 'nullable|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'field_of_study_id' => 'nullable|string|max:255',
            'start_year' => 'required|string|max:50',
            'end_year' => 'required|string|max:50',
            'grade' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'description_id' => 'nullable|string',
            'achievements' => 'nullable|string',
            'achievements_id' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (! empty($validated['achievements'])) {
            $validated['achievements'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $validated['achievements'])))));
        } else {
            $validated['achievements'] = [];
        }

        if (! empty($validated['achievements_id'])) {
            $validated['achievements_id'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $validated['achievements_id'])))));
        } else {
            $validated['achievements_id'] = [];
        }

        Education::create($validated);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record created successfully.');
    }

    public function edit(Education $education): View
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'degree_id' => 'nullable|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'field_of_study_id' => 'nullable|string|max:255',
            'start_year' => 'required|string|max:50',
            'end_year' => 'required|string|max:50',
            'grade' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'description_id' => 'nullable|string',
            'achievements' => 'nullable|string',
            'achievements_id' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (isset($validated['achievements'])) {
            $validated['achievements'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $validated['achievements'])))));
        }

        if (isset($validated['achievements_id'])) {
            $validated['achievements_id'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $validated['achievements_id'])))));
        }

        $education->update($validated);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record updated successfully.');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record deleted successfully.');
    }
}

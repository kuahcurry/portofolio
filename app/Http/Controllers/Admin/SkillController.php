<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        $skills = Skill::orderBy('type', 'desc')->orderBy('category')->orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create(): View
    {
        return view('admin.skills.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if (is_numeric($request->input('proficiency'))) {
            $num = (int) $request->input('proficiency');
            $request->merge(['proficiency' => $num >= 90 ? 'expert' : ($num >= 80 ? 'advanced' : ($num >= 60 ? 'intermediate' : 'beginner'))]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_id' => 'nullable|string|max:255',
            'type' => 'nullable|in:technical,soft',
            'category' => 'required|string|max:100',
            'proficiency' => 'required|string|in:expert,advanced,intermediate,beginner',
            'description' => 'nullable|string',
            'description_id' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['type'] = $validated['type'] ?? 'technical';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill added successfully.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        if (is_numeric($request->input('proficiency'))) {
            $num = (int) $request->input('proficiency');
            $request->merge(['proficiency' => $num >= 90 ? 'expert' : ($num >= 80 ? 'advanced' : ($num >= 60 ? 'intermediate' : 'beginner'))]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_id' => 'nullable|string|max:255',
            'type' => 'nullable|in:technical,soft',
            'category' => 'required|string|max:100',
            'proficiency' => 'required|string|in:expert,advanced,intermediate,beginner',
            'description' => 'nullable|string',
            'description_id' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['type'] = $validated['type'] ?? 'technical';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $skill->update($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill removed successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::orderBy('sort_order')->latest('updated_at')->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'tagline' => 'nullable|string|max:255',
            'tagline_id' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'category_id' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_id' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1000',
            'github_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'certificate_url' => 'nullable|url|max:255',
            'certificate_image' => 'nullable|string|max:1000',
            'technologies' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            // Ensure unique slug
            $original = $validated['slug'];
            $count = 1;
            while (Project::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = "{$original}-".$count++;
            }
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (! empty($validated['technologies'])) {
            $validated['technologies'] = array_values(array_filter(array_map('trim', explode(',', $validated['technologies']))));
        } else {
            $validated['technologies'] = [];
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,'.$project->id,
            'tagline' => 'nullable|string|max:255',
            'tagline_id' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'category_id' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_id' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1000',
            'github_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'certificate_url' => 'nullable|url|max:255',
            'certificate_image' => 'nullable|string|max:1000',
            'technologies' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_values(array_filter(array_map('trim', explode(',', $validated['technologies']))));
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}

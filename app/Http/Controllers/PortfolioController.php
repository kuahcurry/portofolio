<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $profile = Profile::first();
        $education = Education::orderBy('sort_order')->get();
        $experiences = Experience::orderBy('sort_order')->get();
        $projects = Project::orderBy('sort_order')->get();

        $skills = Skill::orderBy('sort_order')->get();

        $technicalSkills = $skills->where('type', 'technical');
        $softSkills = $skills->where('type', 'soft');

        $groupedSkills = [
            'languages' => $technicalSkills->where('category', 'programming_language'),
            'frameworks' => $technicalSkills->where('category', 'framework'),
            'databases' => $technicalSkills->where('category', 'database'),
            'tools' => $technicalSkills->where('category', 'tools'),
        ];

        $categories = $projects->pluck('category')->unique()->values();

        return view('portfolio.index', compact(
            'profile',
            'education',
            'experiences',
            'projects',
            'groupedSkills',
            'softSkills',
            'categories'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AtsGeneratorController extends Controller
{
    public function index(Request $request): View
    {
        $targetLocale = $request->get('lang', app()->getLocale());
        if (! in_array($targetLocale, ['en', 'id'])) {
            $targetLocale = 'en';
        }
        app()->setLocale($targetLocale);

        $profile = Profile::first();
        $education = Education::orderBy('sort_order')->latest('start_year')->get();
        $experiences = Experience::orderBy('sort_order')->latest('start_date')->get();
        $projects = Project::orderBy('sort_order')->get();

        $skills = Skill::orderBy('sort_order')->get();
        $technicalSkills = $skills->where('type', 'technical');
        $softSkills = $skills->where('type', 'soft');

        // Generate clean ATS plain text versions for parsing systems
        $bioText = $this->buildBioAtsText($profile, $targetLocale);
        $skillsText = $this->buildSkillsAtsText($technicalSkills, $softSkills, $targetLocale);
        $experiencesText = $this->buildExperiencesAtsText($experiences, $targetLocale);
        $educationText = $this->buildEducationAtsText($education, $targetLocale);
        $projectsText = $this->buildProjectsAtsText($projects, $targetLocale);

        $plainText = $this->buildHeaderAtsText($profile)."\n\n".
            $bioText."\n\n".
            $skillsText."\n\n".
            $experiencesText."\n\n".
            $educationText."\n\n".
            $projectsText;

        return view('admin.ats.index', compact(
            'profile',
            'education',
            'experiences',
            'projects',
            'technicalSkills',
            'softSkills',
            'plainText',
            'bioText',
            'skillsText',
            'experiencesText',
            'educationText',
            'projectsText',
            'targetLocale'
        ));
    }

    private function buildHeaderAtsText($profile): string
    {
        $lines = [];
        $lines[] = strtoupper($profile->name ?? 'PORTFOLIO CANDIDATE');
        $contactBits = array_filter([
            $profile->email ?? null,
            $profile->phone ?? null,
            $profile->location ?? null,
            $profile->linkedin_url ?? null,
            $profile->github_url ?? null,
            $profile->website_url ?? null,
        ]);
        $lines[] = implode(' | ', $contactBits);

        return implode("\n", $lines);
    }

    private function buildBioAtsText($profile, string $locale): string
    {
        $lines = [];
        $header = $locale === 'id' ? 'RINGKASAN PROFESIONAL' : 'PROFESSIONAL SUMMARY';
        $lines[] = $header;
        $lines[] = str_repeat('-', 40);
        $title = $profile->trans('title') ?? 'Software Architect';
        $tagline = $profile->trans('tagline') ?? '';
        $lines[] = $title.($tagline ? ' — '.$tagline : '');
        $bio = $profile->trans('bio');
        if (! empty($bio)) {
            $cleanBio = strip_tags(str_replace(["\r", "\n\n"], ['', "\n"], $bio));
            $lines[] = $cleanBio;
        }

        return implode("\n", $lines);
    }

    private function buildSkillsAtsText($technicalSkills, $softSkills, string $locale): string
    {
        $lines = [];
        $header = $locale === 'id' ? 'KOMPETENSI UTAMA & KEAHLIAN TEKNOLOGI' : 'CORE TECHNICAL & BEHAVIORAL COMPETENCIES';
        $lines[] = $header;
        $lines[] = str_repeat('-', 40);

        $langLabel = $locale === 'id' ? '• Bahasa Pemrograman: ' : '• Programming Languages: ';
        $frameLabel = $locale === 'id' ? '• Framework & Arsitektur UI: ' : '• Frameworks & Libraries: ';
        $dbLabel = $locale === 'id' ? '• Basis Data & Manajemen Penyimpanan: ' : '• Databases & Storage: ';
        $toolLabel = $locale === 'id' ? '• Cloud, DevOps & Otomasi CI/CD: ' : '• Cloud, DevOps & Tools: ';
        $softLabel = $locale === 'id' ? '• Kepemimpinan Arsitektural & Manajerial: ' : '• Architectural & Leadership Competencies: ';

        $languages = $technicalSkills->where('category', 'programming_language')->map(fn ($s) => $s->trans('name'))->implode(', ');
        if ($languages) {
            $lines[] = $langLabel.$languages;
        }

        $frameworks = $technicalSkills->where('category', 'framework')->map(fn ($s) => $s->trans('name'))->implode(', ');
        if ($frameworks) {
            $lines[] = $frameLabel.$frameworks;
        }

        $databases = $technicalSkills->where('category', 'database')->map(fn ($s) => $s->trans('name'))->implode(', ');
        if ($databases) {
            $lines[] = $dbLabel.$databases;
        }

        $tools = $technicalSkills->where('category', 'tools')->map(fn ($s) => $s->trans('name'))->implode(', ');
        if ($tools) {
            $lines[] = $toolLabel.$tools;
        }

        if ($softSkills->isNotEmpty()) {
            $softList = $softSkills->map(fn ($s) => $s->trans('name'))->implode(' • ');
            $lines[] = $softLabel.$softList;
        }

        return implode("\n", $lines);
    }

    private function buildExperiencesAtsText($experiences, string $locale): string
    {
        $lines = [];
        $header = $locale === 'id' ? 'PENGALAMAN KERJA PROFESIONAL' : 'PROFESSIONAL EXPERIENCE';
        $lines[] = $header;
        $lines[] = str_repeat('-', 40);
        foreach ($experiences as $exp) {
            $role = $exp->trans('role');
            $lines[] = strtoupper($role).' | '.$exp->company.' ('.($exp->location ?? 'Remote').')';
            $lines[] = $exp->start_date.' – '.$exp->end_date;

            $desc = $exp->trans('description');
            if ($desc) {
                $lines[] = $desc;
            }

            $highlights = $exp->trans('highlights');
            if (! empty($highlights) && is_array($highlights)) {
                foreach ($highlights as $h) {
                    $lines[] = '  * '.$h;
                }
            }
            if (! empty($exp->technologies) && is_array($exp->technologies)) {
                $lines[] = '  Technologies: '.implode(', ', $exp->technologies);
            }
            if ($exp->certificate_url) {
                $lines[] = '  Credential: '.$exp->certificate_url;
            }
            $lines[] = '';
        }

        return rtrim(implode("\n", $lines));
    }

    private function buildEducationAtsText($education, string $locale): string
    {
        $lines = [];
        $header = $locale === 'id' ? 'PENDIDIKAN & KUALIFIKASI AKADEMIK' : 'EDUCATION & CREDENTIALS';
        $lines[] = $header;
        $lines[] = str_repeat('-', 40);
        foreach ($education as $edu) {
            $degree = $edu->trans('degree');
            $field = $edu->trans('field_of_study');
            $lines[] = strtoupper($degree).' — '.$field;
            $lines[] = $edu->institution.' | '.$edu->start_year.' – '.$edu->end_year;
            if ($edu->grade) {
                $lines[] = '  Honors/GPA: '.$edu->grade;
            }
            $desc = $edu->trans('description');
            if ($desc) {
                $lines[] = '  '.$desc;
            }
            $achievements = $edu->trans('achievements');
            if (! empty($achievements) && is_array($achievements)) {
                foreach ($achievements as $ach) {
                    $lines[] = '  * '.$ach;
                }
            }
            $lines[] = '';
        }

        return rtrim(implode("\n", $lines));
    }

    private function buildProjectsAtsText($projects, string $locale): string
    {
        $lines = [];
        if ($projects->isNotEmpty()) {
            $header = $locale === 'id' ? 'PORTOFOLIO REKAYASA & PROYEK PILIHAN' : 'KEY ENGINEERING PROJECTS';
            $lines[] = $header;
            $lines[] = str_repeat('-', 40);
            foreach ($projects as $proj) {
                $title = $proj->trans('title');
                $cat = $proj->trans('category');
                $lines[] = strtoupper($title).' ('.$cat.')';
                $tagline = $proj->trans('tagline');
                if ($tagline) {
                    $lines[] = '  '.$tagline;
                }
                $lines[] = '  '.$proj->trans('description');
                if (! empty($proj->technologies) && is_array($proj->technologies)) {
                    $lines[] = '  Technologies: '.implode(', ', $proj->technologies);
                }
                $links = array_filter([
                    $proj->github_url ? 'Code: '.$proj->github_url : null,
                    $proj->website_url ? 'Demo: '.$proj->website_url : null,
                    $proj->certificate_url ? 'Credential: '.$proj->certificate_url : null,
                ]);
                if (! empty($links)) {
                    $lines[] = '  Links: '.implode(' | ', $links);
                }
                $lines[] = '';
            }
        }

        return rtrim(implode("\n", $lines));
    }
}

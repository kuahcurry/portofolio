@extends('layouts.admin')

@section('title', 'Edit Skill — ' . $skill->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between border-b border-[#E8E5DC] pb-4">
        <div>
            <h1 class="font-serif text-3xl font-bold text-[#1C1917]">Edit Technical Competency</h1>
            <p class="text-sm text-[#57534E] mt-1">Editing <span class="font-semibold text-[#1C1917]">{{ $skill->name }}</span></p>
        </div>
        <a href="{{ route('admin.skills.index') }}" class="text-xs font-mono text-[#78716C] hover:text-[#1C1917]">
            &larr; Back to Skills
        </a>
    </div>

    <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="bg-white rounded-2xl border border-[#E8E5DC] p-6 sm:p-10 space-y-8 shadow-xs">
        @csrf
        @method('PUT')

        <!-- Competency Classification & Type -->
        <div class="space-y-6">
            <div>
                <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-2 font-semibold">Competency Type *</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="flex items-center gap-3 p-3.5 rounded-xl border border-[#D6D3D1] bg-[#FAF9F6] cursor-pointer hover:bg-white transition">
                        <input type="radio" name="type" value="technical" {{ old('type', $skill->type ?? 'technical') === 'technical' ? 'checked' : '' }} class="text-[#1C1917] focus:ring-[#1C1917]">
                        <div>
                            <span class="text-xs font-mono font-semibold text-[#1C1917] block">Technical Skill</span>
                            <span class="text-[11px] text-[#78716C] block">Language, framework, database, cloud tools</span>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-xl border border-[#D6D3D1] bg-[#FAF9F6] cursor-pointer hover:bg-white transition">
                        <input type="radio" name="type" value="soft" {{ old('type', $skill->type ?? 'technical') === 'soft' ? 'checked' : '' }} class="text-[#1C1917] focus:ring-[#1C1917]">
                        <div>
                            <span class="text-xs font-mono font-semibold text-[#1C1917] block">Soft Skill</span>
                            <span class="text-[11px] text-[#78716C] block">Leadership, architecture, collaboration</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">Classification Category *</label>
                    <select name="category" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#FAF9F6] border border-[#D6D3D1] text-sm text-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none">
                        <optgroup label="Technical Competencies">
                            <option value="programming_language" {{ old('category', $skill->category) == 'programming_language' ? 'selected' : '' }}>Programming Language</option>
                            <option value="framework" {{ old('category', $skill->category) == 'framework' ? 'selected' : '' }}>Framework &amp; Component System</option>
                            <option value="database" {{ old('category', $skill->category) == 'database' ? 'selected' : '' }}>Database &amp; Storage</option>
                            <option value="tools" {{ old('category', $skill->category) == 'tools' ? 'selected' : '' }}>DevOps, Cloud &amp; Tools</option>
                        </optgroup>
                        <optgroup label="Soft Skills &amp; Leadership">
                            <option value="leadership" {{ old('category', $skill->category) == 'leadership' ? 'selected' : '' }}>Architectural Leadership &amp; Mentorship</option>
                            <option value="collaboration" {{ old('category', $skill->category) == 'collaboration' ? 'selected' : '' }}>Cross-Functional Collaboration</option>
                            <option value="problem_solving" {{ old('category', $skill->category) == 'problem_solving' ? 'selected' : '' }}>Root Cause Analysis &amp; Problem Solving</option>
                            <option value="communication" {{ old('category', $skill->category) == 'communication' ? 'selected' : '' }}>Technical Writing &amp; Specs</option>
                            <option value="execution" {{ old('category', $skill->category) == 'execution' ? 'selected' : '' }}>Agile &amp; Continuous Delivery</option>
                        </optgroup>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">Proficiency Level *</label>
                    <select name="proficiency" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#FAF9F6] border border-[#D6D3D1] text-sm text-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none">
                        <option value="expert" {{ old('proficiency', $skill->level_key) === 'expert' ? 'selected' : '' }}>Expert / Pakar (Mastery &amp; architectural authority)</option>
                        <option value="advanced" {{ old('proficiency', $skill->level_key) === 'advanced' ? 'selected' : '' }}>Advanced / Tingkat Lanjut (Extensive production experience)</option>
                        <option value="intermediate" {{ old('proficiency', $skill->level_key) === 'intermediate' ? 'selected' : '' }}>Intermediate / Menengah (Solid working competency)</option>
                        <option value="beginner" {{ old('proficiency', $skill->level_key) === 'beginner' ? 'selected' : '' }}>Beginner / Pemula (Foundational understanding)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Bilingual Content: 2 Columns -->
        <div class="pt-6 border-t border-[#F4F2EB]">
            <div class="flex items-center justify-between border-b border-[#F4F2EB] pb-2 mb-6">
                <div>
                    <h3 class="font-serif text-lg font-bold text-[#1C1917]">Skill Name &amp; Application</h3>
                    <p class="text-xs text-[#78716C] font-mono mt-0.5">English on the left, Indonesian on the right.</p>
                </div>
                <div class="flex items-center gap-2 text-xs font-mono">
                    <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-800 border border-blue-200">🇬🇧 English</span>
                    <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-800 border border-emerald-200">🇮🇩 Indonesia</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Column 1: English -->
                <div class="space-y-5 p-5 rounded-xl bg-[#FAF9F6] border border-[#E8E5DC]">
                    <div class="flex items-center gap-2 border-b border-[#E8E5DC] pb-2">
                        <span class="text-base">🇬🇧</span>
                        <h4 class="text-xs font-mono uppercase tracking-wider font-bold text-[#1C1917]">English Presentation</h4>
                    </div>

                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">Skill / Technology Name *</label>
                        <input type="text" name="name" value="{{ old('name', $skill->name) }}" required class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-[#D6D3D1] text-sm text-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">Description / Architectural Application</label>
                        <textarea name="description" rows="3" placeholder="Briefly describe how this skill is applied in architectural, team, or production contexts..." class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-[#D6D3D1] text-sm text-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none leading-relaxed">{{ old('description', $skill->description) }}</textarea>
                    </div>
                </div>

                <!-- Column 2: Indonesian -->
                <div class="space-y-5 p-5 rounded-xl bg-[#FAF9F6] border border-[#E8E5DC]">
                    <div class="flex items-center gap-2 border-b border-[#E8E5DC] pb-2">
                        <span class="text-base">🇮🇩</span>
                        <h4 class="text-xs font-mono uppercase tracking-wider font-bold text-[#1C1917]">Presentasi Bahasa Indonesia</h4>
                    </div>

                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">Nama Keahlian / Teknologi (ID)</label>
                        <input type="text" name="name_id" value="{{ old('name_id', $skill->name_id) }}" placeholder="cth. Pola Pikir Sistem Terdistribusi" class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-[#D6D3D1] text-sm text-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">Deskripsi / Penerapan Praktis (ID)</label>
                        <textarea name="description_id" rows="3" placeholder="Jelaskan secara singkat bagaimana keahlian ini diterapkan dalam konteks tim atau arsitektur..." class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-[#D6D3D1] text-sm text-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none leading-relaxed">{{ old('description_id', $skill->description_id) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Settings -->
        <div class="space-y-6 pt-6 border-t border-[#F4F2EB]">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">Material Symbol Icon Identifier</label>
                    <input type="text" name="icon" value="{{ old('icon', $skill->icon) }}" placeholder="code, psychology, groups, troubleshoot..." class="w-full px-3.5 py-2.5 rounded-lg bg-[#FAF9F6] border border-[#D6D3D1] text-sm text-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none">
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">Display Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#FAF9F6] border border-[#D6D3D1] text-sm text-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-[#F4F2EB] flex justify-end gap-3">
            <a href="{{ route('admin.skills.index') }}" class="px-5 py-2.5 rounded-lg border border-[#D5D1C6] text-xs font-mono text-[#57534E] hover:bg-[#F4F2EB]">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#1C1917] text-[#FAF9F6] font-medium text-xs font-mono hover:bg-[#322F2D] transition shadow-xs flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                <span>Update Skill</span>
            </button>
        </div>
    </form>

</div>
@endsection

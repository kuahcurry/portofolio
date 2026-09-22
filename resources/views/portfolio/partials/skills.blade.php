<section id="skills" class="py-20 md:py-28 border-b border-[#E8E5DC] bg-[#FAF9F6]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-2 text-[#8F6A3B] text-xs font-mono tracking-widest uppercase font-semibold">
                <span>{{ __('portfolio.section_skills_number') }}</span>
                <span class="w-8 h-px bg-[#8F6A3B]"></span>
                <span>{{ __('portfolio.section_skills_label') }}</span>
            </div>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight text-[#1C1917] mt-2">
                {{ __('portfolio.section_skills_title') }}
            </h2>
            <p class="text-[#57534E] text-base mt-2 leading-relaxed">
                {{ __('portfolio.section_skills_subtitle') }}
            </p>
        </div>

        <!-- Part A: Technical Skills (Languages, Frameworks, Databases, Tools) -->
        <div class="mb-16">
            <div class="flex items-center gap-3 mb-8">
                <span class="text-xs font-mono uppercase tracking-widest text-[#8F6A3B] font-bold">{{ __('portfolio.domain_technical') }}</span>
                <span class="flex-1 h-px bg-[#E8E5DC]"></span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Programming Languages -->
                <div class="bg-white rounded-xl border border-[#E8E5DC] p-6 sm:p-8 portfolio-card-hover shadow-xs">
                    <div class="flex items-center gap-3 border-b border-[#F4F2EB] pb-4 mb-6">
                        <span class="w-9 h-9 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B]">
                            <span class="material-symbols-outlined text-lg">code</span>
                        </span>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-[#1C1917]">
                                {{ app()->getLocale() === 'id' ? 'Bahasa Pemrograman' : 'Programming Languages' }}
                            </h3>
                            <p class="text-xs text-[#78716C] font-mono">Syntax, memory models &amp; type safety</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @foreach($groupedSkills['languages'] as $skill)
                            <div class="flex items-center justify-between p-2.5 rounded-lg hover:bg-[#FAF9F6] border border-transparent hover:border-[#E8E5DC] transition-all">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="w-8 h-8 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B] shrink-0">
                                        <span class="material-symbols-outlined text-base">{{ $skill->icon ?? 'terminal' }}</span>
                                    </span>
                                    <div class="min-w-0">
                                        <span class="font-medium text-[#1C1917] text-sm block truncate">{{ $skill->trans('name') }}</span>
                                        @if($skill->trans('description'))
                                            <span class="text-xs text-[#78716C] block truncate">{{ $skill->trans('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="shrink-0 pl-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-mono font-medium border {{ $skill->level_badge_class }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $skill->level_dot_class }}"></span>
                                        <span>{{ $skill->level_label }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Frameworks & Component Systems -->
                <div class="bg-white rounded-xl border border-[#E8E5DC] p-6 sm:p-8 portfolio-card-hover shadow-xs">
                    <div class="flex items-center gap-3 border-b border-[#F4F2EB] pb-4 mb-6">
                        <span class="w-9 h-9 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B]">
                            <span class="material-symbols-outlined text-lg">layers</span>
                        </span>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-[#1C1917]">
                                {{ app()->getLocale() === 'id' ? 'Framework & Sistem UI' : 'Frameworks & UI Systems' }}
                            </h3>
                            <p class="text-xs text-[#78716C] font-mono">Modern web orchestration &amp; design tokens</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @foreach($groupedSkills['frameworks'] as $skill)
                            <div class="flex items-center justify-between p-2.5 rounded-lg hover:bg-[#FAF9F6] border border-transparent hover:border-[#E8E5DC] transition-all">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="w-8 h-8 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B] shrink-0">
                                        <span class="material-symbols-outlined text-base">{{ $skill->icon ?? 'layers' }}</span>
                                    </span>
                                    <div class="min-w-0">
                                        <span class="font-medium text-[#1C1917] text-sm block truncate">{{ $skill->trans('name') }}</span>
                                        @if($skill->trans('description'))
                                            <span class="text-xs text-[#78716C] block truncate">{{ $skill->trans('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="shrink-0 pl-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-mono font-medium border {{ $skill->level_badge_class }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $skill->level_dot_class }}"></span>
                                        <span>{{ $skill->level_label }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Databases & In-Memory Storage -->
                <div class="bg-white rounded-xl border border-[#E8E5DC] p-6 sm:p-8 portfolio-card-hover shadow-xs">
                    <div class="flex items-center gap-3 border-b border-[#F4F2EB] pb-4 mb-6">
                        <span class="w-9 h-9 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B]">
                            <span class="material-symbols-outlined text-lg">storage</span>
                        </span>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-[#1C1917]">
                                {{ app()->getLocale() === 'id' ? 'Basis Data & Penyimpanan' : 'Databases & Storage' }}
                            </h3>
                            <p class="text-xs text-[#78716C] font-mono">Relational modeling, indexing &amp; queues</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @foreach($groupedSkills['databases'] as $skill)
                            <div class="flex items-center justify-between p-2.5 rounded-lg hover:bg-[#FAF9F6] border border-transparent hover:border-[#E8E5DC] transition-all">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="w-8 h-8 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B] shrink-0">
                                        <span class="material-symbols-outlined text-base">{{ $skill->icon ?? 'storage' }}</span>
                                    </span>
                                    <div class="min-w-0">
                                        <span class="font-medium text-[#1C1917] text-sm block truncate">{{ $skill->trans('name') }}</span>
                                        @if($skill->trans('description'))
                                            <span class="text-xs text-[#78716C] block truncate">{{ $skill->trans('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="shrink-0 pl-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-mono font-medium border {{ $skill->level_badge_class }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $skill->level_dot_class }}"></span>
                                        <span>{{ $skill->level_label }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- DevOps & Architecture -->
                <div class="bg-white rounded-xl border border-[#E8E5DC] p-6 sm:p-8 portfolio-card-hover shadow-xs">
                    <div class="flex items-center gap-3 border-b border-[#F4F2EB] pb-4 mb-6">
                        <span class="w-9 h-9 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B]">
                            <span class="material-symbols-outlined text-lg">architecture</span>
                        </span>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-[#1C1917]">
                                {{ app()->getLocale() === 'id' ? 'DevOps, CI/CD & Alat Cloud' : 'DevOps, CI/CD & Cloud Tools' }}
                            </h3>
                            <p class="text-xs text-[#78716C] font-mono">Containerization, automated suites &amp; cloud</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @foreach($groupedSkills['tools'] as $skill)
                            <div class="flex items-center justify-between p-2.5 rounded-lg hover:bg-[#FAF9F6] border border-transparent hover:border-[#E8E5DC] transition-all">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="w-8 h-8 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B] shrink-0">
                                        <span class="material-symbols-outlined text-base">{{ $skill->icon ?? 'architecture' }}</span>
                                    </span>
                                    <div class="min-w-0">
                                        <span class="font-medium text-[#1C1917] text-sm block truncate">{{ $skill->trans('name') }}</span>
                                        @if($skill->trans('description'))
                                            <span class="text-xs text-[#78716C] block truncate">{{ $skill->trans('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="shrink-0 pl-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-mono font-medium border {{ $skill->level_badge_class }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $skill->level_dot_class }}"></span>
                                        <span>{{ $skill->level_label }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <!-- Part B: Soft Skills & Architectural Leadership -->
        <div>
            <div class="flex items-center gap-3 mb-8">
                <span class="text-xs font-mono uppercase tracking-widest text-[#8F6A3B] font-bold">{{ __('portfolio.domain_soft') }}</span>
                <span class="flex-1 h-px bg-[#E8E5DC]"></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($softSkills as $soft)
                    <div class="bg-white rounded-xl border border-[#E8E5DC] p-6 portfolio-card-hover shadow-xs flex flex-col justify-between space-y-4">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="w-10 h-10 rounded-lg bg-[#FAF9F6] border border-[#E8E5DC] flex items-center justify-center text-[#8F6A3B]">
                                    <span class="material-symbols-outlined text-xl">{{ $soft->icon ?? 'psychology' }}</span>
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-mono font-medium border {{ $soft->level_badge_class }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $soft->level_dot_class }}"></span>
                                    <span>{{ $soft->level_label }}</span>
                                </span>
                            </div>

                            <h3 class="font-serif text-lg font-bold text-[#1C1917] leading-snug">
                                {{ $soft->trans('name') }}
                            </h3>

                            @if($soft->trans('description'))
                                <p class="text-sm text-[#57534E] leading-relaxed">
                                    {{ $soft->trans('description') }}
                                </p>
                            @endif
                        </div>

                        <div class="pt-3 border-t border-[#F4F2EB] flex items-center gap-1.5 text-xs text-[#8F6A3B] font-mono">
                            <span class="material-symbols-outlined text-sm">verified_user</span>
                            <span>{{ __('portfolio.soft_skills_badge') }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-[#78716C] italic font-mono col-span-3">No soft skills recorded yet.</p>
                @endforelse
            </div>
        </div>

    </div>
</section>

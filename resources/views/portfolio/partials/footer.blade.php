<footer class="bg-[#1C1917] text-[#FAF9F6] py-14">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 pb-10 border-b border-white/10">
            
            <!-- Left: Classical Brand -->
            <div class="flex items-center space-x-3 text-center md:text-left">
                <span class="w-9 h-9 rounded-lg bg-white/10 text-white flex items-center justify-center font-serif text-lg font-bold">
                    {{ substr($profile->name ?? 'AV', 0, 1) }}
                </span>
                <div>
                    <h4 class="font-serif text-lg font-bold tracking-tight text-[#FAF9F6]">
                        {{ $profile->name ?? 'Alexander Vance' }}
                    </h4>
                    <p class="text-xs text-white/50 font-mono">
                        {{ $profile->trans('title') ?? 'Senior Full-Stack Engineer & Architect' }}
                    </p>
                </div>
            </div>

            <!-- Middle: Quick Navigation -->
            <div class="flex flex-wrap justify-center gap-6 text-xs font-mono uppercase tracking-wider text-white/70">
                <a href="#hero" class="hover:text-white transition-colors">{{ __('portfolio.nav_bio') }}</a>
                <a href="#education" class="hover:text-white transition-colors">{{ __('portfolio.nav_education') }}</a>
                <a href="#experience" class="hover:text-white transition-colors">{{ __('portfolio.nav_experience') }}</a>
                <a href="#projects" class="hover:text-white transition-colors">{{ __('portfolio.nav_projects') }}</a>
                <a href="#skills" class="hover:text-white transition-colors">{{ __('portfolio.nav_skills') }}</a>
                <a href="#contact" class="hover:text-white transition-colors">{{ __('portfolio.nav_contact') }}</a>
                <a href="#work-together" class="hover:text-white transition-colors">{{ __('portfolio.nav_work_together') }}</a>
                <a href="{{ route('api.docs') }}" class="hover:text-white transition-colors">API Docs</a>
                <a href="{{ route('system.status') }}" class="hover:text-white transition-colors">Status</a>
            </div>

            <!-- Right: Return to top -->
            <div>
                <a href="#hero" class="inline-flex items-center gap-2 text-xs font-mono text-white/70 hover:text-white transition-colors p-2 rounded-lg bg-white/5 hover:bg-white/10">
                    <span>{{ __('portfolio.back_to_top') }}</span>
                    <span class="material-symbols-outlined text-sm">arrow_upward</span>
                </a>
            </div>

        </div>

        <!-- Bottom Line -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-white/50">
            <p>
                &copy; {{ date('Y') }} {{ $profile->name ?? 'Alexander Vance' }}. {{ __('portfolio.footer_tagline') }}
            </p>
            <p class="flex items-center gap-2">
                <span>Built with</span>
                <span class="text-white/80 font-medium">Laravel</span>
                <span>&bull;</span>
                <span class="text-white/80 font-medium">Tailwind CSS</span>
                <span>&bull;</span>
                <span class="text-white/80 font-medium">Material Web M3</span>
            </p>
        </div>
    </div>
</footer>

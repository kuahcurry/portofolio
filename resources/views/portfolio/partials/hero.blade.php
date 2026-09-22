<section id="hero" class="relative pt-12 pb-20 md:pt-20 md:pb-28 border-b border-[#E8E5DC] overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Bio & Introduction Text (7 cols) -->
            <div class="lg:col-span-7 order-2 lg:order-1 space-y-6">
                <!-- Status Pill -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#FAF9F6] border border-[#D5D1C6] text-xs font-medium text-[#57534E] shadow-xs">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-600"></span>
                    </span>
                    <span>{{ $profile->availability_status ?? __('portfolio.available_for_hire') }}</span>
                </div>

                <!-- Main Classical Heading -->
                <div class="space-y-2">
                    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#1C1917] leading-[1.12]">
                        {{ $profile->name ?? 'Alexander Vance' }}
                    </h1>
                    <p class="text-lg sm:text-xl font-medium text-[#8F6A3B] tracking-wide">
                        {{ $profile->trans('title') ?? 'Senior Full-Stack Engineer & Software Architect' }}
                    </p>
                </div>

                <!-- Classical Tagline Quote -->
                @if($profile->trans('tagline'))
                    <blockquote class="border-l-2 border-[#8F6A3B] pl-4 italic font-serif text-lg text-[#57534E] leading-relaxed">
                        "{{ $profile->trans('tagline') }}"
                    </blockquote>
                @endif

                <!-- Full Bio Content -->
                <div id="bio" class="space-y-4 text-base text-[#57534E] leading-relaxed pt-2">
                    @php
                        $bioContent = $profile->trans('bio');
                    @endphp
                    @if(!empty($bioContent))
                        @foreach(explode("\n\n", $bioContent) as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    @else
                        <p>I specialize in architecting scalable, resilient web platforms using Laravel, modern component architectures, and robust cloud data layers. My work is anchored in minimalist aesthetics, type-safety, and timeless software craftsmanship.</p>
                    @endif
                </div>

                <!-- Location & Quick Metadata -->
                <div class="flex flex-wrap items-center gap-y-2 gap-x-6 text-sm text-[#78716C] pt-2">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-[#8F6A3B]">location_on</span>
                        <span>{{ $profile->location ?? 'San Francisco, CA / Remote' }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-[#8F6A3B]">history_edu</span>
                        <span>{{ $profile->years_of_experience ?? '6' }}+ {{ __('portfolio.years_experience') }}</span>
                    </div>
                </div>

                <!-- Material Web Action Buttons -->
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    <a href="#work-together" class="text-decoration-none">
                        <md-filled-button style="--md-filled-button-container-color: #1C1917; --md-filled-button-label-text-color: #FAF9F6; height: 44px; padding-left: 20px; padding-right: 20px;">
                            <span slot="icon" class="material-symbols-outlined">handshake</span>
                            {{ __('portfolio.nav_work_together') }}
                        </md-filled-button>
                    </a>
                    
                    <a href="#projects" class="text-decoration-none">
                        <md-outlined-button style="--md-outlined-button-outline-color: #1C1917; --md-outlined-button-label-text-color: #1C1917; height: 44px; padding-left: 20px; padding-right: 20px;">
                            <span slot="icon" class="material-symbols-outlined">folder_open</span>
                            {{ __('portfolio.view_portfolio') }}
                        </md-outlined-button>
                    </a>

                    @if(!empty($profile->github_url))
                        <a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer" class="p-2.5 rounded-lg border border-[#D5D1C6] text-[#1C1917] hover:bg-[#F4F2EB] hover:border-[#1C1917] transition-all" title="GitHub Profile">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                    @endif

                    @if(!empty($profile->linkedin_url))
                        <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="p-2.5 rounded-lg border border-[#D5D1C6] text-[#1C1917] hover:bg-[#F4F2EB] hover:border-[#1C1917] transition-all" title="LinkedIn Profile">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Picture / Portrait Frame (5 cols) -->
            <div class="lg:col-span-5 order-1 lg:order-2 flex justify-center">
                <div class="relative w-full max-w-sm">
                    <div class="absolute inset-0 translate-x-3 translate-y-3 rounded-2xl border-2 border-[#D5D1C6] pointer-events-none"></div>
                    <div class="relative rounded-2xl overflow-hidden bg-[#FFFFFF] p-2.5 border border-[#E8E5DC] shadow-md">
                        <div class="aspect-[4/5] rounded-xl overflow-hidden bg-[#F4F2EB] relative group">
                            <img 
                                src="{{ $profile->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80' }}" 
                                alt="{{ $profile->name ?? 'Portrait' }}" 
                                class="w-full h-full object-cover object-center filter grayscale contrast-[1.05] group-hover:grayscale-0 transition-all duration-700 ease-out"
                                loading="eager"
                                referrerpolicy="no-referrer"
                            >
                            <div class="absolute bottom-3 right-3 bg-[#1C1917]/90 text-[#FAF9F6] text-xs font-serif px-2.5 py-1 rounded-md backdrop-blur-xs tracking-wider border border-white/10">
                                EST. {{ 2026 - ($profile->years_of_experience ?? 6) }}
                            </div>
                        </div>

                        <!-- Caption under picture -->
                        <div class="pt-3 pb-1 px-2 text-center border-t border-[#F4F2EB] mt-2">
                            <p class="font-serif text-sm font-semibold text-[#1C1917] tracking-wide">
                                {{ $profile->name ?? 'Alexander Vance' }}
                            </p>
                            <p class="text-xs text-[#78716C] font-mono mt-0.5">
                                [{{ $profile->email ?? 'alexander.vance.dev@gmail.com' }}]
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

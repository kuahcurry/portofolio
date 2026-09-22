<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Default Admin User for the manage. subdomain
        User::updateOrCreate(
            ['email' => 'admin@portfolio.local'],
            [
                'name' => 'Portfolio Administrator',
                'password' => bcrypt('admin12345'),
            ]
        );

        // 1. Profile / Bio / Contact details
        Profile::create([
            'name' => 'Alexander Vance',
            'title' => 'Senior Full-Stack Engineer & Software Architect',
            'title_id' => 'Senior Full-Stack Engineer & Software Architect',
            'tagline' => 'Crafting enduring, high-performance web systems with architectural discipline.',
            'tagline_id' => 'Menghadirkan sistem web berdaya tahan tinggi dan berkinerja unggul melalui disiplin arsitektur perangkat lunak.',
            'bio' => "I am a full-stack engineer and software architect with over six years of professional experience building resilient backend architectures, high-concurrency systems, and polished, accessible user interfaces.\n\nMy philosophy balances classical engineering craftsmanship with modern minimalist design: clean typography, zero bloat, type-safety, and dependable scalability. Whether architecting distributed systems or refining micro-interactions, I focus on building digital products that stand the test of time.",
            'bio_id' => "Profesional di bidang rekayasa perangkat lunak dan arsitektur sistem dengan pengalaman lebih dari enam tahun dalam merancang infrastruktur backend berskala besar, sistem berkonkurensi tinggi, serta antarmuka digital yang intuitif dan berstandar industri tinggi.\n\nFilosofi kerja saya memadukan presisi rekayasa klasik dengan desain minimalis modern: penulisan kode yang terstruktur dan aman (type-safe), performa optimal tanpa redundansi, serta skalabilitas jangka panjang yang teruji. Baik dalam merancang arsitektur sistem terdistribusi maupun menyempurnakan interaksi pengguna, komitmen utama saya adalah menghadirkan solusi teknologi yang tangguh, aman, dan berkelanjutan.",
            'short_bio' => 'Specializing in Laravel, TypeScript, distributed systems, Tailwind CSS, and Material Web component architectures.',
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
            'location' => 'San Francisco, CA / Remote Worldwide',
            'email' => 'alexander.vance.dev@gmail.com',
            'phone' => '+1 (415) 890-4321',
            'github_url' => 'https://github.com/alexandervance-dev',
            'linkedin_url' => 'https://linkedin.com/in/alexander-vance',
            'twitter_url' => 'https://x.com/alexvance_dev',
            'website_url' => 'https://alexandervance.dev',
            'resume_url' => '#',
            'availability_status' => 'Available for selective contracts & architectural advisory',
            'years_of_experience' => 6,
        ]);

        // 2. Education
        Education::create([
            'institution' => 'University of California, Berkeley',
            'degree' => 'Bachelor of Science in Computer Science',
            'degree_id' => 'Sarjana Ilmu Komputer (B.S. in Computer Science)',
            'field_of_study' => 'Computer Science & Software Systems',
            'field_of_study_id' => 'Ilmu Komputer & Rekayasa Perangkat Lunak',
            'start_year' => '2018',
            'end_year' => '2022',
            'grade' => 'GPA 3.92 / 4.00 (Magna Cum Laude)',
            'description' => 'Focused on distributed computing, database management systems, and algorithmic efficiency. Completed senior capstone on fault-tolerant consensus mechanisms in microservice networks.',
            'description_id' => 'Fokus pendalaman pada komputasi terdistribusi, arsitektur basis data berskala besar, dan optimasi algoritma. Menyelesaikan tugas akhir mengenai mekanisme konsensus toleran kegagalan (fault-tolerant) pada arsitektur microservices.',
            'achievements' => [
                'Dean\'s Honors List for 7 consecutive academic semesters',
                'Lead Undergraduate Researcher in Distributed Storage Systems',
                'President of the Open Source Engineering Society (2021 - 2022)',
            ],
            'achievements_id' => [
                'Penghargaan Kehormatan Dekan (Dean\'s List) selama 7 semester akademik berturut-turut',
                'Peneliti Utama Tingkat Sarjana untuk Sistem Penyimpanan Terdistribusi',
                'Ketua Perhimpunan Rekayasa Sumber Terbuka (Open Source Engineering Society, 2021–2022)',
            ],
            'sort_order' => 1,
        ]);

        Education::create([
            'institution' => 'Stanford Center for Professional Development',
            'degree' => 'Advanced Graduate Certificate',
            'degree_id' => 'Sertifikasi Pascasarjana Lanjutan (Advanced Graduate Certificate)',
            'field_of_study' => 'Cloud Systems & Scalable Database Architectures',
            'field_of_study_id' => 'Sistem Cloud & Arsitektur Basis Data Terdistribusi',
            'start_year' => '2022',
            'end_year' => '2023',
            'grade' => 'Distinction with Honors',
            'description' => 'Specialized coursework covering cloud-native computing, partitioned data stores, high-availability replication protocols, and container orchestration.',
            'description_id' => 'Kurikulum tingkat lanjut mencakup komputasi cloud-native, penyimpanan data terpartisi, protokol replikasi ketersediaan tinggi, dan orkestrasi kontainer.',
            'achievements' => [
                'Capstone Excellence Award for high-throughput stream processing blueprint',
            ],
            'achievements_id' => [
                'Penghargaan Proyek Terbaik (Capstone Excellence) untuk cetak biru pemrosesan aliran data berkecepatan tinggi',
            ],
            'sort_order' => 2,
        ]);

        // 3. Experience
        Experience::create([
            'role' => 'Lead Full-Stack Engineer',
            'role_id' => 'Lead Full-Stack Engineer',
            'company' => 'Lumina Cloud Infrastructure',
            'company_url' => 'https://lumina.example.com',
            'location' => 'San Francisco, CA (Hybrid)',
            'start_date' => '2023',
            'end_date' => 'Present',
            'is_current' => true,
            'description' => 'Directing the architecture and implementation of Lumina\'s next-generation telemetry platform and customer control portal.',
            'description_id' => 'Memimpin perancangan arsitektur dan implementasi platform telemetri generasi terbaru serta portal kendali operasional pelanggan di Lumina.',
            'highlights' => [
                'Architected unified multi-tenant telemetry ingestion pipeline handling 18M+ events/day with 99.99% uptime.',
                'Spearheaded modern component design system transition using Tailwind CSS and Material Web components, boosting team shipping velocity by 40%.',
                'Reduced API p99 latency from 310ms to 42ms through strategic Redis caching layers and SQL query refactoring.',
                'Mentored 6 junior and mid-level software engineers across backend, automated testing, and web accessibility standards.',
            ],
            'highlights_id' => [
                'Merancang pipeline konsumsi data telemetri multi-tenant yang memproses lebih dari 18 juta event per hari dengan ketersediaan layanan (uptime) 99,99%.',
                'Menginisiasi standardisasi sistem desain komponen antarmuka menggunakan Tailwind CSS dan Material Web, meningkatkan kecepatan peluncuran fitur sebesar 40%.',
                'Mengoptimalkan latensi API p99 dari 310ms menjadi 42ms melalui integrasi caching Redis dan restrukturisasi kueri SQL.',
                'Membimbing 6 pengembang perangkat lunak dalam penguasaan arsitektur backend, otomasi pengujian, dan kepatuhan standar aksesibilitas web.',
            ],
            'technologies' => ['Laravel', 'PHP 8.4', 'Tailwind CSS', 'Material Web', 'PostgreSQL', 'Redis', 'Docker', 'AWS'],
            'certificate_url' => 'https://credentials.example.com/certs/lumina-staff-architect-2024',
            'sort_order' => 1,
        ]);

        Experience::create([
            'role' => 'Senior Backend Engineer',
            'role_id' => 'Senior Backend Engineer',
            'company' => 'Meridian Financial Technologies',
            'company_url' => 'https://meridian.example.com',
            'certificate_url' => 'https://credentials.example.com/certs/meridian-security-compliance',
            'location' => 'New York, NY (Remote)',
            'start_date' => '2021',
            'end_date' => '2023',
            'is_current' => false,
            'description' => 'Developed core transaction engines, reconciliation systems, and third-party payment integration APIs for enterprise fintech clients.',
            'description_id' => 'Mengembangkan mesin pemrosesan transaksi inti, sistem rekonsiliasi data keuangan, dan integrasi API gerbang pembayaran untuk klien perbankan dan fintech berskala enterprise.',
            'highlights' => [
                'Designed idempotent payment processing gateway processing over $45M in gross volume each month.',
                'Implemented automated audit trails and cryptographic log verification satisfying SOC2 Type II compliance.',
                'Integrated multiple banking clearinghouses via REST and Webhook protocols with automated retry mechanisms.',
            ],
            'highlights_id' => [
                'Merancang payment gateway idempoten yang memproses volume transaksi bruto lebih dari $45 juta per bulan secara aman dan konsisten.',
                'Mengimplementasikan jejak audit otomatis dan verifikasi log kriptografis yang memenuhi sertifikasi kepatuhan SOC2 Tipe II.',
                'Mengintegrasikan berbagai lembaga kliring perbankan melalui arsitektur REST dan Webhook dengan mekanisme pemulihan otomatis (retry mechanisms).',
            ],
            'technologies' => ['Laravel', 'PHP', 'MySQL', 'RabbitMQ', 'Tailwind CSS', 'Docker', 'Stripe API'],
            'sort_order' => 2,
        ]);

        Experience::create([
            'role' => 'Software Developer',
            'role_id' => 'Software Developer',
            'company' => 'Monolith Digital Solutions',
            'company_url' => 'https://monolith.example.com',
            'certificate_url' => null,
            'location' => 'Austin, TX (Remote)',
            'start_date' => '2019',
            'end_date' => '2021',
            'is_current' => false,
            'description' => 'Built high-traffic custom web platforms, e-commerce stores, and internal operational tooling for national brands.',
            'description_id' => 'Membangun platform web bervolume trafik tinggi, infrastruktur e-commerce terintegrasi, serta perkakas operasional internal untuk mitra bisnis nasional.',
            'highlights' => [
                'Engineered 14+ bespoke web applications and API microservices from initial scoping to production deployment.',
                'Improved page load speeds by 65% across client sites by optimizing asset bundling, queries, and critical rendering paths.',
            ],
            'highlights_id' => [
                'Mengembangkan lebih dari 14 aplikasi web kustom dan microservices dari tahap perancangan spesifikasi hingga implementasi produksi.',
                'Meningkatkan performa kecepatan akses halaman sebesar 65% melalui optimasi bundling aset, efisiensi alokasi memori, dan penyempurnaan critical rendering path.',
            ],
            'technologies' => ['Laravel', 'PHP', 'JavaScript', 'Tailwind CSS', 'MySQL', 'Git'],
            'sort_order' => 3,
        ]);

        // 4. Projects (Git repo + live link + certificate/award link included)
        Project::create([
            'title' => 'Aura Task Orchestrator',
            'title_id' => 'Aura Task Orchestrator',
            'slug' => 'aura-task-orchestrator',
            'tagline' => 'High-concurrency distributed job pipeline & workflow scheduler',
            'tagline_id' => 'Platform orkestrator pipeline tugas terdistribusi & penjadwal alur kerja berkecepatan tinggi',
            'description' => 'A robust, self-hosted job orchestrator built with Laravel and Redis. Features real-time worker telemetry, intelligent rate-limiting, dead-letter queue analysis, and interactive visual DAG pipelines.',
            'description_id' => 'Solusi orkestrasi tugas tingkat enterprise yang dibangun di atas Laravel dan Redis. Menghadirkan pemantauan telemetri worker secara real-time, mekanisme pembatasan laju pintar, analisis antrean bermasalah (dead-letter queue), dan visualisasi alur DAG yang interaktif.',
            'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80',
            'category' => 'Distributed Systems & Backend',
            'category_id' => 'Sistem Terdistribusi & Backend',
            'github_url' => 'https://github.com/alexandervance-dev/aura-orchestrator',
            'website_url' => 'https://aura-orchestrator.demo.dev',
            'certificate_url' => 'https://credentials.example.com/projects/aura-architecture-award',
            'technologies' => ['Laravel', 'PHP 8.4', 'Redis', 'Tailwind CSS', 'Material Web', 'WebSockets', 'Docker'],
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Chronicle Docs Engine',
            'title_id' => 'Chronicle Docs Engine',
            'slug' => 'chronicle-docs-engine',
            'tagline' => 'Classical typographic markdown publishing & documentation system',
            'tagline_id' => 'Platform dokumentasi teknis & publikasi markdown berbasis tipografi editorial klasik',
            'description' => 'A minimalist documentation platform designed around classical editorial typography and lightning-fast full-text search. Supports algorithmic dark/light themes, offline PWA caching, and automated API spec parsing.',
            'description_id' => 'Sistem dokumentasi minimalis yang mengedepankan keterbacaan tipografi editorial dan kapabilitas pencarian teks instan. Dilengkapi integrasi tema gelap/terang otomatis, persistensi offline PWA, dan penguraian spesifikasi OpenAPI.',
            'thumbnail' => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=800&q=80',
            'category' => 'Developer Tools & UI',
            'category_id' => 'Perangkat Pengembang & UI',
            'github_url' => 'https://github.com/alexandervance-dev/chronicle-docs',
            'website_url' => 'https://chronicle.demo.dev',
            'certificate_url' => 'https://credentials.example.com/projects/chronicle-design-excellence',
            'technologies' => ['Laravel', 'Tailwind CSS', 'Material Web M3', 'SQLite', 'Alpine.js'],
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'Veritas Metrics & Analytics',
            'title_id' => 'Veritas Metrics & Analytics',
            'slug' => 'veritas-analytics',
            'tagline' => 'Cookieless, privacy-first web telemetry & event analytics platform',
            'tagline_id' => 'Platform analitik event & telemetri web tanpa cookie yang mengutamakan privasi pengguna',
            'description' => 'An ethical, lightweight alternative to bloated tracking suites. Collects privacy-preserving event data, computes real-time retention matrices, and renders beautiful Material Design 3 interactive charts.',
            'description_id' => 'Infrastruktur analitik web mandiri tanpa pelacakan cookie invasif. Mengumpulkan data telemetri secara anonim, menghitung metrik retensi secara real-time, serta menyajikan visualisasi data interaktif berbasis Material Design 3.',
            'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
            'category' => 'Full-Stack Web Application',
            'category_id' => 'Aplikasi Web Terintegrasi',
            'github_url' => 'https://github.com/alexandervance-dev/veritas-analytics',
            'website_url' => 'https://veritas-analytics.demo.dev',
            'certificate_url' => null,
            'technologies' => ['Laravel', 'PostgreSQL', 'Tailwind CSS', 'Material Web', 'Chart.js', 'REST API'],
            'is_featured' => true,
            'sort_order' => 3,
        ]);

        Project::create([
            'title' => 'Symphony Modular Commerce',
            'title_id' => 'Symphony Modular Commerce',
            'slug' => 'symphony-modular-commerce',
            'tagline' => 'Headless e-commerce core with atomic inventory locks and payment orchestration',
            'tagline_id' => 'Infrastruktur e-commerce headless dengan penguncian inventaris atomik & integrasi pembayaran',
            'description' => 'High-reliability digital commerce backend handling multi-currency orders, automatic invoice generation, Stripe/PayPal payment routing, and real-time stock sync.',
            'description_id' => 'Backend perdagangan digital keandalan tinggi untuk pengelolaan transaksi multi-mata uang, penerbitan faktur otomatis, perutean gerbang pembayaran Stripe/PayPal, dan sinkronisasi stok secara simultan.',
            'thumbnail' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=800&q=80',
            'category' => 'E-Commerce & FinTech',
            'category_id' => 'E-Commerce & FinTech',
            'github_url' => 'https://github.com/alexandervance-dev/symphony-commerce',
            'website_url' => 'https://symphony-store.demo.dev',
            'certificate_url' => null,
            'technologies' => ['Laravel', 'Tailwind CSS', 'MySQL', 'Stripe API', 'Material Web'],
            'is_featured' => false,
            'sort_order' => 4,
        ]);

        Project::create([
            'title' => 'Helios API Profiler',
            'title_id' => 'Helios API Profiler',
            'slug' => 'helios-api-profiler',
            'tagline' => 'Real-time database query bottleneck detector and payload analyzer',
            'tagline_id' => 'Alat diagnostik kinerja basis data & penganalisis bottleneck kueri real-time',
            'description' => 'A developer companion tool that monitors SQL statement counts, detects N+1 execution flaws, inspects memory allocations, and provides actionable code suggestions.',
            'description_id' => 'Perangkat pemantauan komprehensif bagi pengembang untuk mendeteksi bottleneck kueri SQL, mengatasi anomali eksekusi N+1, menganalisis profil alokasi memori, serta menyajikan rekomendasi optimasi kode secara terukur.',
            'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
            'category' => 'Developer Productivity',
            'category_id' => 'Produktivitas Rekayasa',
            'github_url' => 'https://github.com/alexandervance-dev/helios-profiler',
            'website_url' => 'https://helios-profiler.demo.dev',
            'certificate_url' => null,
            'technologies' => ['PHP 8.4', 'Laravel', 'SQLite', 'Tailwind CSS'],
            'is_featured' => false,
            'sort_order' => 5,
        ]);

        // 5. Skills: Technical Skills & Soft Architectural Leadership Skills
        $skills = [
            // Programming Languages (Technical)
            ['name' => 'PHP 8.x', 'name_id' => 'PHP 8.x', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'expert', 'icon' => 'code', 'sort_order' => 1],
            ['name' => 'TypeScript / JavaScript', 'name_id' => 'TypeScript / JavaScript', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'expert', 'icon' => 'javascript', 'sort_order' => 2],
            ['name' => 'SQL (PostgreSQL / MySQL)', 'name_id' => 'SQL (PostgreSQL / MySQL)', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'expert', 'icon' => 'database', 'sort_order' => 3],
            ['name' => 'Python', 'name_id' => 'Python', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'advanced', 'icon' => 'terminal', 'sort_order' => 4],
            ['name' => 'Go', 'name_id' => 'Go', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'intermediate', 'icon' => 'speed', 'sort_order' => 5],
            ['name' => 'HTML5 & Modern CSS', 'name_id' => 'HTML5 & CSS Modern', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'expert', 'icon' => 'html', 'sort_order' => 6],

            // Frameworks (Technical)
            ['name' => 'Laravel Framework', 'name_id' => 'Framework Laravel', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'expert', 'icon' => 'layers', 'sort_order' => 1],
            ['name' => 'Tailwind CSS', 'name_id' => 'Tailwind CSS', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'expert', 'icon' => 'style', 'sort_order' => 2],
            ['name' => 'Material Web Components (M3)', 'name_id' => 'Material Web Components (M3)', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'expert', 'icon' => 'widgets', 'sort_order' => 3],
            ['name' => 'Vue.js / React', 'name_id' => 'Vue.js / React', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'advanced', 'icon' => 'view_quilt', 'sort_order' => 4],
            ['name' => 'Alpine.js', 'name_id' => 'Alpine.js', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'expert', 'icon' => 'bolt', 'sort_order' => 5],
            ['name' => 'Livewire / Inertia.js', 'name_id' => 'Livewire / Inertia.js', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'advanced', 'icon' => 'sync_alt', 'sort_order' => 6],

            // Databases (Technical)
            ['name' => 'PostgreSQL', 'name_id' => 'PostgreSQL', 'type' => 'technical', 'category' => 'database', 'proficiency' => 'expert', 'icon' => 'storage', 'sort_order' => 1],
            ['name' => 'MySQL / MariaDB', 'name_id' => 'MySQL / MariaDB', 'type' => 'technical', 'category' => 'database', 'proficiency' => 'expert', 'icon' => 'table_chart', 'sort_order' => 2],
            ['name' => 'SQLite', 'name_id' => 'SQLite', 'type' => 'technical', 'category' => 'database', 'proficiency' => 'expert', 'icon' => 'folder_zip', 'sort_order' => 3],
            ['name' => 'Redis (Cache & Queues)', 'name_id' => 'Redis (Cache & Antrean Cepat)', 'type' => 'technical', 'category' => 'database', 'proficiency' => 'expert', 'icon' => 'memory', 'sort_order' => 4],

            // Tools & Architecture (Technical)
            ['name' => 'Docker & Containerization', 'name_id' => 'Docker & Kontainerisasi', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'advanced', 'icon' => 'inventory_2', 'sort_order' => 1],
            ['name' => 'Git & GitHub Workflows', 'name_id' => 'Alur Kerja Git & GitHub', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'expert', 'icon' => 'commit', 'sort_order' => 2],
            ['name' => 'CI/CD Pipelines (GitHub Actions)', 'name_id' => 'Pipeline CI/CD (GitHub Actions)', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'advanced', 'icon' => 'published_with_changes', 'sort_order' => 3],
            ['name' => 'RESTful API & GraphQL Design', 'name_id' => 'Perancangan RESTful API & GraphQL', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'expert', 'icon' => 'hub', 'sort_order' => 4],
            ['name' => 'AWS Cloud Services', 'name_id' => 'Layanan Cloud AWS', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'advanced', 'icon' => 'cloud_queue', 'sort_order' => 5],
            ['name' => 'Automated Testing (Pest / PHPUnit)', 'name_id' => 'Pengujian Otomatis (Pest / PHPUnit)', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'expert', 'icon' => 'fact_check', 'sort_order' => 6],

            // Soft Skills & Architectural Leadership
            [
                'name' => 'Distributed Systems Thinking',
                'name_id' => 'Pola Pikir Sistem Terdistribusi',
                'type' => 'soft',
                'category' => 'leadership',
                'proficiency' => 'expert',
                'description' => 'Decomposing complex enterprise domains into decoupled, horizontally scalable, and fault-tolerant architectural components.',
                'description_id' => 'Mendekomposisi domain bisnis yang kompleks menjadi layanan modular yang terdesentralisasi, berketahanan tinggi, dan siap diskalakan secara horizontal.',
                'icon' => 'psychology',
                'sort_order' => 1,
            ],
            [
                'name' => 'Engineering Leadership & Mentorship',
                'name_id' => 'Kepemimpinan Rekayasa & Mentoring Teknis',
                'type' => 'soft',
                'category' => 'leadership',
                'proficiency' => 'expert',
                'description' => 'Fostering engineering craftsmanship, instituting architectural review rigor, and mentoring engineers across backend, testing, and system design.',
                'description_id' => 'Membangun budaya rekayasa perangkat lunak yang unggul, menegakkan standar tinjauan arsitektur kode yang ketat, serta membina kapasitas teknis tim.',
                'icon' => 'groups',
                'sort_order' => 2,
            ],
            [
                'name' => 'Cross-Functional Product Collaboration',
                'name_id' => 'Kolaborasi Lintas Fungsi & Manajemen Produk',
                'type' => 'soft',
                'category' => 'collaboration',
                'proficiency' => 'expert',
                'description' => 'Bridging business vision with technical reality through transparent roadmap planning, user empathy, and pragmatic trade-off analysis.',
                'description_id' => 'Menyelaraskan sasaran strategis bisnis dengan kapabilitas teknis melalui komunikasi transparan, perencanaan roadmap terukur, dan pengambilan keputusan pragmatis.',
                'icon' => 'handshake',
                'sort_order' => 3,
            ],
            [
                'name' => 'Root Cause Analysis & Incident Triage',
                'name_id' => 'Analisis Akar Masalah & Manajemen Insiden Kritis',
                'type' => 'soft',
                'category' => 'problem_solving',
                'proficiency' => 'expert',
                'description' => 'High-pressure diagnostic composure, systematic post-mortem analysis, and engineering preventive guardrails against systemic failures.',
                'description_id' => 'Ketajaman investigasi teknis di situasi darurat, penyusunan laporan post-mortem komprehensif, serta perancangan mekanisme pencegahan preventif.',
                'icon' => 'troubleshoot',
                'sort_order' => 4,
            ],
            [
                'name' => 'Technical Writing & Architecture Specs',
                'name_id' => 'Dokumentasi Teknis & Spesifikasi Arsitektur',
                'type' => 'soft',
                'category' => 'communication',
                'proficiency' => 'expert',
                'description' => 'Authoring unambiguous RFCs, system architecture blueprints, OpenAPI contracts, and developer onboarding manuals.',
                'description_id' => 'Menyusun dokumen RFC, spesifikasi arsitektur sistem, kontrak antarmuka API, dan panduan teknis yang presisi, terstruktur, dan mudah diadopsi tim.',
                'icon' => 'history_edu',
                'sort_order' => 5,
            ],
            [
                'name' => 'Agile & Continuous Delivery Orchestration',
                'name_id' => 'Orkestrasi Agile & Pengiriman Perangkat Lunak Berkelanjutan',
                'type' => 'soft',
                'category' => 'execution',
                'proficiency' => 'expert',
                'description' => 'Championing trunk-based development, automated quality gates, and iterative value delivery without compromising codebase stability.',
                'description_id' => 'Menerapkan metodologi trunk-based development, automated quality gates, dan siklus peluncuran fitur berulang tanpa mengorbankan stabilitas sistem produksi.',
                'icon' => 'published_with_changes',
                'sort_order' => 6,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}

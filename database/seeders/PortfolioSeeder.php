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
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Aqief Hakimi',
                'title' => 'Backend Engineer & Cloud Computing Specialist',
                'title_id' => 'Spesialis Rekayasa Backend & Komputasi Cloud',
                'tagline' => 'Architecting dependable APIs, scalable cloud systems, and high-performance web applications.',
                'tagline_id' => 'Membangun API andal, infrastruktur cloud skalabel, dan aplikasi web berkinerja tinggi.',
                'bio' => "I am a passionate, versatile software engineer with a strong foundation in backend API development, cloud architecture, and modern web systems. Graduated in Computer Science from Universitas Ahmad Dahlan and an alumnus of Google Bangkit Academy (Cloud Computing Path).\n\nI specialize in architecting resilient backend services and leveraging Google Cloud Platform to build scalable, production-grade solutions. With professional working English proficiency (CEFR B2), a solid background in creative visual design (Figma, Adobe Illustrator, CorelDRAW), and academic leadership as a Laboratory Teaching Assistant Coordinator, I bring both technical rigor and clear communication to engineering teams.",
                'bio_id' => "Saya adalah seorang software engineer dengan keahlian mendalam pada rekayasa backend API, arsitektur komputasi cloud, dan pengembangan web modern. Lulusan S1 Informatika dari Universitas Ahmad Dahlan serta alumni program bergengsi Bangkit Academy 2024 yang dipimpin oleh Google (Jalur Cloud Computing).\n\nFokus utama saya adalah membangun layanan backend yang andal dan memanfaatkan Google Cloud Platform untuk menciptakan arsitektur sistem yang skalabel dan efisien. Didukung kemampuan bahasa Inggris profesional (tingkat B2), keahlian desain kreatif (Figma, Illustrator, CorelDRAW), serta pengalaman kepemimpinan sebagai Koordinator Asisten Praktikum di laboratorium kampus, saya berkomitmen menghadirkan solusi teknologi yang berdampak nyata dan berstandar tinggi.",
                'short_bio' => 'Backend & Cloud Specialist | Laravel, GCP, PHP, MySQL, REST APIs, Docker, and Web Systems.',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
                'location' => 'Surabaya & Yogyakarta, Indonesia',
                'email' => 'aqefhakimi32@gmail.com',
                'phone' => '+62 855-1655-7899',
                'github_url' => 'https://github.com/kuahcurry',
                'linkedin_url' => 'https://www.linkedin.com/in/aqief-hakimi-37ab5b27a',
                'twitter_url' => null,
                'website_url' => 'https://hakimi.work',
                'resume_url' => '#',
                'availability_status' => 'Available for Full-time Roles & Engineering Collaborations',
                'years_of_experience' => 2,
            ]
        );

        // 2. Education
        Education::truncate();

        Education::create([
            'institution' => 'Universitas Ahmad Dahlan',
            'degree' => 'Bachelor of Computer Science (S.Kom.)',
            'degree_id' => 'Sarjana Ilmu Komputer (S.Kom.)',
            'field_of_study' => 'Informatics & Information Technology',
            'field_of_study_id' => 'Informatika / Teknologi Informasi',
            'start_year' => '2022',
            'end_year' => '2026',
            'grade' => 'Fresh Graduate',
            'description' => 'Focused on backend systems, cloud architectures, and interactive multimedia. Actively served as a Laboratory Teaching Assistant Coordinator across core computer science practical courses.',
            'description_id' => 'Fokus pada arsitektur backend, sistem komputasi cloud, dan grafika multimedia. Aktif berkontribusi sebagai Koordinator Asisten Praktikum di laboratorium inti ilmu komputer.',
            'achievements' => [
                'Coordinator of Laboratory Teaching Assistants for Applied Computer Graphics (2025 - 2026)',
                'Laboratory Teaching Assistant for Dynamic Web Programming and Multimedia Technology',
                'Selected Cohort Member of Google Bangkit Academy 2024 (Cloud Computing Path)',
            ],
            'achievements_id' => [
                'Koordinator Asisten Praktikum Grafika Terapan (2025–2026)',
                'Asisten Praktikum Pemrograman Web Dinamis dan Teknologi Multimedia',
                'Peserta Terpilih Bangkit Academy 2024 Program Studi Independen Jalur Cloud Computing',
            ],
            'sort_order' => 1,
        ]);

        Education::create([
            'institution' => 'SMA Trensains Muhammadiyah Sragen',
            'degree' => 'High School Diploma',
            'degree_id' => 'Ijazah Sekolah Menengah Atas (MIPA)',
            'field_of_study' => 'Natural Sciences (MIPA)',
            'field_of_study_id' => 'Matematika dan Ilmu Pengetahuan Alam (MIPA)',
            'start_year' => '2019',
            'end_year' => '2022',
            'grade' => 'Graduated',
            'description' => 'Rigorous natural science and mathematics education fostering strong analytical problem-solving, structured scientific inquiry, and algorithmic foundations.',
            'description_id' => 'Pendidikan sains dan matematika intensif yang membentuk fondasi kuat dalam pemecahan masalah analitis, logika terstruktur, dan penyelidikan ilmiah.',
            'achievements' => [
                'Active involvement in science, mathematics, and technological extracurricular initiatives',
            ],
            'achievements_id' => [
                'Aktif dalam berbagai kegiatan sains, matematika, dan inisiatif teknologi',
            ],
            'sort_order' => 2,
        ]);

        // 3. Experience (Work & Leadership)
        Experience::truncate();

        Experience::create([
            'role' => 'Multimedia Technology Laboratory Teaching Assistant',
            'role_id' => 'Asisten Praktikum Teknologi Multimedia',
            'company' => 'Universitas Ahmad Dahlan',
            'company_url' => 'https://uad.ac.id',
            'certificate_url' => null,
            'location' => 'D.I. Yogyakarta, Indonesia',
            'start_date' => '2026-03-01',
            'end_date' => '2026-08-31',
            'is_current' => false,
            'description' => 'Guided undergraduate informatics students through advanced multimedia computing principles, digital audio/video processing, interactive media design, and multimedia rendering workflows.',
            'description_id' => 'Membimbing mahasiswa teknik informatika dalam pemahaman praktis komputasi multimedia tingkat lanjut, pemrosesan audio/video digital, perancangan media interaktif, serta implementasi alur kerja rendering grafis.',
            'highlights' => [
                'Supervised and mentored 80+ informatics students across weekly lab sessions, instilling deep technical comprehension of multimedia tools and creative pipelines.',
                'Designed structured practical assignment modules and evaluation rubrics that elevated project submission quality by 25%.',
                'Conducted hands-on debugging workshops resolving digital asset rendering, encoding, and compression bottlenecks on lab workstations.',
            ],
            'highlights_id' => [
                'Membimbing dan mengarahkan lebih dari 80 mahasiswa informatika lintas sesi praktikum untuk memastikan penguasaan teknis perangkat lunak multimedia dan alur kerja kreatif.',
                'Merancang modul tugas praktikum dan rubrik evaluasi terstandar yang meningkatkan kualitas proyek akhir mahasiswa sebesar 25%.',
                'Mengadakan sesi bedah teknis dan pemecahan masalah terkait rendering aset digital, encoding, dan kompresi media pada workstation laboratorium.',
            ],
            'technologies' => ['Multimedia Computing', 'Audio/Video Processing', 'Interactive Media', 'Adobe Illustrator', 'Figma', 'Lab Mentorship'],
            'sort_order' => 1,
        ]);

        Experience::create([
            'role' => 'Coordinator of Applied Computer Graphics Laboratory Teaching Assistants',
            'role_id' => 'Koordinator Asisten Praktikum Grafika Terapan',
            'company' => 'Universitas Ahmad Dahlan',
            'company_url' => 'https://uad.ac.id',
            'certificate_url' => null,
            'location' => 'D.I. Yogyakarta, Indonesia',
            'start_date' => '2025-08-01',
            'end_date' => '2026-01-31',
            'is_current' => false,
            'description' => 'Spearheaded the teaching assistant cohort for the Applied Computer Graphics course, overseeing instructional delivery, lab schedules, and evaluation standards for 2D/3D visual rendering algorithms.',
            'description_id' => 'Memimpin tim asisten praktikum mata kuliah Grafika Terapan, bertanggung jawab atas koordinasi pengajaran instruksional, penjadwalan laboratorium, dan standarisasi evaluasi algoritma rendering visual 2D/3D.',
            'highlights' => [
                'Coordinated a cohesive cohort of 6+ lab assistants, establishing standardized instructional benchmarks, grading criteria, and synchronized semester schedules.',
                'Delivered comprehensive lectures on computer graphics principles, vector transformations, rasterization algorithms, and shader fundamentals.',
                'Streamlined assessment and code-review workflows, cutting student assignment evaluation turnaround time by 30%.',
            ],
            'highlights_id' => [
                'Mengoordinasikan tim beranggotakan 6+ asisten laboratorium, menyusun tolok ukur pengajaran terstandar, rubrik penilaian objektif, dan jadwal instruksional semester.',
                'Menyampaikan materi praktikum mengenai prinsip grafika komputer, transformasi matriks vektor, algoritma rasterisasi, dan dasar-dasar rendering visual.',
                'Mengoptimalkan alur evaluasi tugas dan tinjauan kode mahasiswa, mempercepat waktu penilaian sebesar 30%.',
            ],
            'technologies' => ['Computer Graphics', 'Vector Transformations', '2D/3D Rendering', 'CorelDRAW', 'Team Leadership', 'Instructional Design'],
            'sort_order' => 2,
        ]);

        Experience::create([
            'role' => 'Dynamic Web Programming Laboratory Teaching Assistant',
            'role_id' => 'Asisten Praktikum Pemrograman Web Dinamis',
            'company' => 'Universitas Ahmad Dahlan',
            'company_url' => 'https://uad.ac.id',
            'certificate_url' => null,
            'location' => 'D.I. Yogyakarta, Indonesia',
            'start_date' => '2025-08-01',
            'end_date' => '2026-01-31',
            'is_current' => false,
            'description' => 'Instructed undergraduate students in full-stack dynamic web development, database connectivity, asynchronous client-server communication, and modern backend MVC architecture.',
            'description_id' => 'Mengajar mahasiswa dalam pengembangan web dinamis full-stack, integrasi basis data relasional, komunikasi asinkron client-server, serta implementasi arsitektur MVC backend modern.',
            'highlights' => [
                'Guided students through hands-on development of database-driven web applications using PHP, MySQL, JavaScript, and asynchronous REST APIs.',
                'Conducted live code debugging workshops, instilling clean code architecture, database normalization, and web security best practices (SQLi/XSS prevention).',
                'Mentored 15+ student project teams in conceptualizing, architecting, and deploying fully functional dynamic web applications.',
            ],
            'highlights_id' => [
                'Membimbing mahasiswa membangun aplikasi web dinamis berbasis basis data menggunakan PHP, MySQL, JavaScript, dan antarmuka REST API asinkron.',
                'Mengadakan workshop live debugging, menekankan arsitektur kode bersih, normalisasi basis data relasional, dan standar keamanan web (pencegahan SQLi/XSS).',
                'Mementori 15+ kelompok proyek mahasiswa dari tahap perancangan arsitektur hingga peluncuran aplikasi web yang fungsional.',
            ],
            'technologies' => ['PHP', 'MySQL', 'JavaScript', 'REST APIs', 'MVC Architecture', 'Web Security', 'Database Design'],
            'sort_order' => 3,
        ]);

        Experience::create([
            'role' => 'E-Doc Web Developer Intern',
            'role_id' => 'E-Doc Web Developer Intern',
            'company' => 'PT. Farma Global Teknologi',
            'company_url' => 'https://farmaglobal.co.id',
            'certificate_url' => null,
            'location' => 'Sleman, D.I. Yogyakarta, Indonesia',
            'start_date' => '2025-02-01',
            'end_date' => '2025-03-31',
            'is_current' => false,
            'description' => 'Engineered responsive web interface systems and dynamic electronic documentation (E-Doc) templates integrated with local server backends to streamline hospital administration workflows.',
            'description_id' => 'Mengembangkan sistem antarmuka web responsif dan templat dokumentasi elektronik (E-Doc) terintegrasi backend server lokal guna mengefisienkan alur kerja administrasi rumah sakit.',
            'highlights' => [
                'Developed 5–6 dynamic, responsive web templates utilizing HTML5, CSS3, JavaScript, and Bootstrap, tailored directly to healthcare administrative workflows.',
                'Integrated web form interfaces with a local server backend to dynamically process medical data and generate standardized PDF documentation quickly and efficiently.',
                'Significantly accelerated internal medical documentation cycles, eliminating repetitive paper-based paperwork and reducing human data entry errors.',
                'Collaborated closely with healthcare operational staff to ensure intuitive UI/UX navigation, accessibility, and high operational reliability in clinical environments.',
            ],
            'highlights_id' => [
                'Mengembangkan 5–6 templat web responsif berbasis HTML5, CSS3, JavaScript, dan Bootstrap yang disesuaikan secara presisi untuk kebutuhan staf administrasi rumah sakit.',
                'Mengintegrasikan antarmuka formulir web dengan backend server lokal untuk memproses data administrasi medis secara dinamis dan menghasilkan dokumen PDF berstandar resmi.',
                'Mempercepat siklus pembuatan dokumen medis internal secara signifikan, mengeliminasi birokrasi kertas berulang, dan meminimalkan kesalahan entri data manual.',
                'Berkolaborasi erat dengan staf operasional layanan kesehatan guna memastikan desain UI/UX yang intuitif, aksesibel, dan berdaya guna tinggi di lingkungan klinis.',
            ],
            'technologies' => ['HTML5', 'CSS3', 'JavaScript', 'Bootstrap', 'Local Server Backend', 'PDF Generation', 'E-Doc Systems'],
            'sort_order' => 4,
        ]);

        Experience::create([
            'role' => 'Cloud Computing Cohort / Specialist',
            'role_id' => 'Cloud Computing Cohort / Specialist',
            'company' => 'Bangkit Academy (Google, Tokopedia, Gojek, Traveloka)',
            'company_url' => 'https://grow.google/intl/id_id/bangkit',
            'certificate_url' => 'https://www.linkedin.com/in/aqief-hakimi-37ab5b27a',
            'location' => 'D.I. Yogyakarta / Remote Indonesia',
            'start_date' => '2024-08-01',
            'end_date' => '2025-01-31',
            'is_current' => false,
            'description' => 'Selected for the prestigious Google-led Cloud Computing career readiness program under Kampus Merdeka, mastering Google Cloud Platform architecture, containerization, and enterprise backend engineering.',
            'description_id' => 'Terpilih untuk program kesiapan karier komputasi cloud bergengsi yang dipimpin Google di bawah Kampus Merdeka, mendalami arsitektur Google Cloud Platform, kontainerisasi, dan rekayasa backend tingkat enterprise.',
            'highlights' => [
                'Completed 900+ curriculum hours covering GCP Compute Engine, Cloud Run, Cloud Storage, Virtual Private Clouds (VPC), IAM security, and automated deployment pipelines.',
                'Architected and deployed scalable, secure backend microservices and RESTful API endpoints for the multidisciplinary Capstone Project.',
                'Earned official Google Cloud skill credentials including "Build a Secure Google Cloud Network" and "Develop your Google Cloud Network".',
                'Demonstrated technical leadership, critical problem-solving, and cross-functional agile collaboration alongside machine learning and mobile development teams.',
            ],
            'highlights_id' => [
                'Menyelesaikan 900+ jam kurikulum komprehensif mencakup GCP Compute Engine, Cloud Run, Cloud Storage, Virtual Private Cloud (VPC), keamanan IAM, dan pipeline deployment otomatis.',
                'Merancang dan mendeploy arsitektur microservices backend dan endpoint RESTful API yang aman dan skalabel untuk Capstone Project lintas disiplin ilmu.',
                'Meraih sertifikasi keahlian resmi Google Cloud, termasuk "Build a Secure Google Cloud Network" dan "Develop your Google Cloud Network".',
                'Menunjukkan kepemimpinan teknis, pemecahan masalah kritis, dan kolaborasi tangkas (Agile) bersama tim Machine Learning dan Mobile Development.',
            ],
            'technologies' => ['Google Cloud Platform', 'Compute Engine', 'Cloud Run', 'Cloud Storage', 'VPC & IAM Security', 'Docker', 'RESTful APIs', 'CI/CD'],
            'sort_order' => 5,
        ]);

        // 4. Projects (Git repo + live link + certificate/award link included)
        // Keep existing user projects intact; only seed sample projects if none exist
        if (Project::count() === 0) {
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
        }

        // 5. Skills: Technical Skills & Soft Leadership Skills
        Skill::truncate();

        $skills = [
            // Cloud Computing & Infrastructure (Technical)
            ['name' => 'Google Cloud Platform (GCP)', 'name_id' => 'Google Cloud Platform (GCP)', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'expert', 'icon' => 'cloud', 'sort_order' => 1],
            ['name' => 'GCP Compute Engine & Cloud Run', 'name_id' => 'GCP Compute Engine & Cloud Run', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'expert', 'icon' => 'dns', 'sort_order' => 2],
            ['name' => 'Cloud Storage, VPC & IAM Security', 'name_id' => 'Cloud Storage, VPC & Keamanan IAM', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'advanced', 'icon' => 'security', 'sort_order' => 3],
            ['name' => 'Docker & Containerization', 'name_id' => 'Docker & Kontainerisasi', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'advanced', 'icon' => 'inventory_2', 'sort_order' => 4],

            // Programming Languages & Backend (Technical)
            ['name' => 'PHP 8.x', 'name_id' => 'PHP 8.x', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'expert', 'icon' => 'code', 'sort_order' => 5],
            ['name' => 'Laravel Framework', 'name_id' => 'Framework Laravel', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'expert', 'icon' => 'layers', 'sort_order' => 6],
            ['name' => 'RESTful APIs & MVC Architecture', 'name_id' => 'RESTful API & Arsitektur MVC', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'expert', 'icon' => 'hub', 'sort_order' => 7],
            ['name' => 'Python', 'name_id' => 'Python', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'advanced', 'icon' => 'terminal', 'sort_order' => 8],
            ['name' => 'MySQL / MariaDB', 'name_id' => 'MySQL / MariaDB', 'type' => 'technical', 'category' => 'database', 'proficiency' => 'expert', 'icon' => 'table_chart', 'sort_order' => 9],
            ['name' => 'PostgreSQL & SQLite', 'name_id' => 'PostgreSQL & SQLite', 'type' => 'technical', 'category' => 'database', 'proficiency' => 'advanced', 'icon' => 'storage', 'sort_order' => 10],

            // Web & Frontend (Technical)
            ['name' => 'HTML5 & Modern CSS3', 'name_id' => 'HTML5 & CSS3 Modern', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'expert', 'icon' => 'html', 'sort_order' => 11],
            ['name' => 'JavaScript', 'name_id' => 'JavaScript', 'type' => 'technical', 'category' => 'programming_language', 'proficiency' => 'advanced', 'icon' => 'javascript', 'sort_order' => 12],
            ['name' => 'Bootstrap Framework', 'name_id' => 'Framework Bootstrap', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'expert', 'icon' => 'view_quilt', 'sort_order' => 13],
            ['name' => 'Tailwind CSS', 'name_id' => 'Tailwind CSS', 'type' => 'technical', 'category' => 'framework', 'proficiency' => 'advanced', 'icon' => 'style', 'sort_order' => 14],

            // Creative, Multimedia & Graphics (Technical)
            ['name' => 'Figma (UI/UX Prototyping)', 'name_id' => 'Figma (Desain UI/UX & Prototipe)', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'expert', 'icon' => 'design_services', 'sort_order' => 15],
            ['name' => 'CorelDRAW (Vector Design)', 'name_id' => 'CorelDRAW (Desain Vektor Grafis)', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'expert', 'icon' => 'draw', 'sort_order' => 16],
            ['name' => 'Adobe Illustrator', 'name_id' => 'Adobe Illustrator', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'advanced', 'icon' => 'brush', 'sort_order' => 17],
            ['name' => 'Computer Graphics & 2D/3D Rendering', 'name_id' => 'Grafika Terapan & Render 2D/3D', 'type' => 'technical', 'category' => 'tools', 'proficiency' => 'advanced', 'icon' => 'auto_awesome', 'sort_order' => 18],

            // Soft Skills & Academic Leadership
            [
                'name' => 'Academic Leadership & Assistant Coordination',
                'name_id' => 'Kepemimpinan Akademik & Koordinasi Asisten',
                'type' => 'soft',
                'category' => 'leadership',
                'proficiency' => 'expert',
                'description' => 'Directing teams of laboratory teaching assistants, managing instructional schedules, and ensuring consistent pedagogical standards across university computer science cohorts.',
                'description_id' => 'Memimpin tim asisten praktikum laboratorium, mengelola jadwal pengajaran, dan menjaga konsistensi standar pembelajaran di lingkungan program studi informatika.',
                'icon' => 'groups',
                'sort_order' => 1,
            ],
            [
                'name' => 'Technical Teaching & Mentorship',
                'name_id' => 'Pengajaran Teknis & Bimbingan Praktikum',
                'type' => 'soft',
                'category' => 'leadership',
                'proficiency' => 'expert',
                'description' => 'Guiding undergraduate students through hands-on full-stack development, interactive debugging, code refactoring, and database schema design.',
                'description_id' => 'Membimbing mahasiswa dalam pemrograman web full-stack, sesi debugging interaktif, penulisan kode bersih, dan perancangan skema basis data.',
                'icon' => 'school',
                'sort_order' => 2,
            ],
            [
                'name' => 'Cross-Functional Agile Collaboration',
                'name_id' => 'Kolaborasi Lintas Fungsi & Metodologi Agile',
                'type' => 'soft',
                'category' => 'collaboration',
                'proficiency' => 'expert',
                'description' => 'Collaborating seamlessly with cross-functional cohorts (Machine Learning, Mobile Dev, Hospital Ops) to deliver robust software solutions on time.',
                'description_id' => 'Berkolaborasi aktif dengan tim lintas disiplin (Machine Learning, Pengembang Mobile, Staf Operasional Medis) untuk merilis solusi perangkat lunak tepat waktu.',
                'icon' => 'handshake',
                'sort_order' => 3,
            ],
            [
                'name' => 'Root Cause Analysis & Problem Solving',
                'name_id' => 'Analisis Akar Masalah & Pemecahan Solutif',
                'type' => 'soft',
                'category' => 'problem_solving',
                'proficiency' => 'expert',
                'description' => 'Analytical mindset for diagnosing complex bugs, tracing database bottlenecks, and ensuring reliable application uptime in production.',
                'description_id' => 'Pola pikir analitis dalam mendiagnosis bug rumit, mengurai bottleneck kueri basis data, dan menjaga keandalan performa aplikasi produksi.',
                'icon' => 'troubleshoot',
                'sort_order' => 4,
            ],
            [
                'name' => 'Professional Technical Communication',
                'name_id' => 'Komunikasi Teknis & Dokumentasi Profesional',
                'type' => 'soft',
                'category' => 'communication',
                'proficiency' => 'advanced',
                'description' => 'Authoring clean technical documentation, lab practical guides, and bilingual specifications in English (CEFR B2) and formal Indonesian.',
                'description_id' => 'Menyusun dokumentasi teknis yang jelas, modul praktikum laboratorium, dan spesifikasi sistem dalam bahasa Inggris (CEFR B2) dan bahasa Indonesia formal.',
                'icon' => 'history_edu',
                'sort_order' => 5,
            ],
            [
                'name' => 'Project & Time Management',
                'name_id' => 'Manajemen Waktu & Eksekusi Proyek Terukur',
                'type' => 'soft',
                'category' => 'execution',
                'proficiency' => 'expert',
                'description' => 'Balancing intensive academic assistant commitments, industry internships, and rigorous certification timelines with disciplined task prioritization.',
                'description_id' => 'Mengelola tanggung jawab asisten akademik, magang industri, dan program sertifikasi intensif secara simultan melalui prioritas tugas yang terdisiplin.',
                'icon' => 'published_with_changes',
                'sort_order' => 6,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}

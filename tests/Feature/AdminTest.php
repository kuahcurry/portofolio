<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PortfolioSeeder::class);
        $this->admin = User::where('email', 'admin@portfolio.local')->first();
    }

    public function test_admin_login_screen_renders(): void
    {
        $response = $this->get('/manage/login');
        $response->assertStatus(200);
        $response->assertSee('Manage Console');
        $response->assertSee('admin@portfolio.local');
    }

    public function test_subdomain_login_screen_renders(): void
    {
        $response = $this->get('http://manage.localhost/login');
        $response->assertStatus(200);
        $response->assertSee('Manage Console');
    }

    public function test_admin_can_authenticate_with_valid_credentials(): void
    {
        $response = $this->post('/manage/login', [
            'email' => 'admin@portfolio.local',
            'password' => 'admin12345',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_admin_cannot_authenticate_with_invalid_credentials(): void
    {
        $response = $this->post('/manage/login', [
            'email' => 'admin@portfolio.local',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get('/manage');
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/manage');
        $response->assertStatus(200);
        $response->assertSee('Management Overview');
        $response->assertSee('Featured Works');
    }

    public function test_admin_can_update_profile(): void
    {
        $response = $this->actingAs($this->admin)->put('/manage/profile', [
            'name' => 'Alexander Vance (Updated)',
            'title' => 'Chief Software Architect',
            'tagline' => 'Crafting enduring systems.',
            'bio' => 'Updated biography text here.',
            'email' => 'alexander.updated@example.com',
            'availability_status' => 'Available immediately',
            'years_of_experience' => 7,
        ]);

        $response->assertRedirect(route('admin.profile.edit'));
        $this->assertDatabaseHas('profiles', [
            'name' => 'Alexander Vance (Updated)',
            'title' => 'Chief Software Architect',
            'email' => 'alexander.updated@example.com',
        ]);
    }

    public function test_admin_can_update_account_credentials(): void
    {
        $response = $this->actingAs($this->admin)->put('/manage/profile/account', [
            'name' => 'New Admin Name',
            'email' => 'newadmin@domain.com',
            'current_password' => 'admin12345',
            'new_password' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('admin.profile.edit'));
        $response->assertSessionHas('account_success');

        $this->admin->refresh();
        $this->assertEquals('New Admin Name', $this->admin->name);
        $this->assertEquals('newadmin@domain.com', $this->admin->email);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('newpassword123', $this->admin->password));
    }

    public function test_admin_can_create_project(): void
    {
        $response = $this->actingAs($this->admin)->post('/manage/projects', [
            'title' => 'Nexus Quantum Gateway',
            'category' => 'Cloud & Distributed Systems',
            'tagline' => 'Next-gen distributed gateway',
            'description' => 'A high speed zero-copy networking gateway built with Laravel and Go.',
            'github_url' => 'https://github.com/example/nexus-gateway',
            'website_url' => 'https://nexus.demo.dev',
            'technologies' => 'Laravel, Go, Docker, Redis',
            'is_featured' => 1,
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', [
            'title' => 'Nexus Quantum Gateway',
            'slug' => 'nexus-quantum-gateway',
            'github_url' => 'https://github.com/example/nexus-gateway',
            'website_url' => 'https://nexus.demo.dev',
        ]);
    }

    public function test_admin_can_delete_project(): void
    {
        $project = Project::first();

        $response = $this->actingAs($this->admin)->delete("/manage/projects/{$project->id}");

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_admin_can_create_experience(): void
    {
        $response = $this->actingAs($this->admin)->post('/manage/experiences', [
            'role' => 'VP of Engineering',
            'company' => 'Aether Labs',
            'location' => 'San Francisco, CA',
            'start_date' => '2024',
            'is_current' => 1,
            'description' => 'Overseeing all architectural infrastructure.',
            'highlights' => "Delivered 99.999% uptime\nLed team of 25 engineers",
            'technologies' => 'Laravel, PostgreSQL, Kubernetes',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.experiences.index'));
        $this->assertDatabaseHas('experiences', [
            'role' => 'VP of Engineering',
            'company' => 'Aether Labs',
        ]);
    }

    public function test_admin_can_create_education(): void
    {
        $response = $this->actingAs($this->admin)->post('/manage/education', [
            'institution' => 'MIT',
            'degree' => 'Master of Science',
            'field_of_study' => 'Distributed Computing',
            'start_year' => '2022',
            'end_year' => '2024',
            'grade' => 'GPA 4.0 / 4.0',
            'description' => 'Research in fault-tolerant peer-to-peer protocols.',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.education.index'));
        $this->assertDatabaseHas('education', [
            'institution' => 'MIT',
            'degree' => 'Master of Science',
        ]);
    }

    public function test_admin_can_create_skill(): void
    {
        $response = $this->actingAs($this->admin)->post('/manage/skills', [
            'name' => 'Rust',
            'category' => 'programming_language',
            'proficiency' => 85,
            'icon' => 'memory',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.skills.index'));
        $this->assertDatabaseHas('skills', [
            'name' => 'Rust',
            'category' => 'programming_language',
        ]);
    }

    public function test_admin_can_view_and_delete_inquiry(): void
    {
        $message = ContactMessage::create([
            'name' => 'Arthur Dent',
            'email' => 'arthur@example.com',
            'subject' => 'Intergalactic Architecture',
            'message' => 'Need help designing a resilient planet-wide system.',
        ]);

        $response = $this->actingAs($this->admin)->get("/manage/messages/{$message->id}");
        $response->assertStatus(200);
        $response->assertSee('Intergalactic Architecture');
        $this->assertTrue($message->fresh()->is_read);

        $deleteResponse = $this->actingAs($this->admin)->delete("/manage/messages/{$message->id}");
        $deleteResponse->assertRedirect(route('admin.messages.index'));
        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }

    public function test_admin_can_access_ats_generator(): void
    {
        $response = $this->actingAs($this->admin)->get('/manage/ats-generator');
        $response->assertStatus(200);
        $response->assertSee('ATS-Friendly Resume Generator');
        $response->assertSee('English ATS');
        $response->assertSee('Indonesian ATS');
        $response->assertSee('Bio');
        $response->assertSee('Education');
        $response->assertSee('Experience');
        $response->assertSee('Projects');
        $response->assertSee('Skills');
        $response->assertSee('PROFESSIONAL SUMMARY');
    }

    public function test_admin_can_switch_ats_generator_to_indonesian(): void
    {
        $response = $this->actingAs($this->admin)->get('/manage/ats-generator?lang=id');
        $response->assertStatus(200);
        $response->assertSee('Indonesian ATS');
        $response->assertSee('RINGKASAN PROFESIONAL');
        $response->assertSee('PENGALAMAN KERJA PROFESIONAL');
        $response->assertSee('PENDIDIKAN &amp; KUALIFIKASI AKADEMIK', false);
    }

    public function test_unauthenticated_user_cannot_access_ats_generator(): void
    {
        $response = $this->get('/manage/ats-generator');
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_project_with_certificate(): void
    {
        $response = $this->actingAs($this->admin)->post('/manage/projects', [
            'title' => 'Quantum Cryptographic Ledger',
            'category' => 'FinTech & Security',
            'tagline' => 'High throughput zero-knowledge verification ledger',
            'description' => 'A cryptographic audit trail platform.',
            'github_url' => 'https://github.com/example/zk-ledger',
            'website_url' => 'https://zk-ledger.example.com',
            'certificate_url' => 'https://credentials.example.com/certs/zk-ledger-patent',
            'certificate_image' => 'https://credentials.example.com/certs/zk-ledger.jpg',
            'technologies' => 'Laravel, Rust, Redis',
            'is_featured' => 1,
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', [
            'title' => 'Quantum Cryptographic Ledger',
            'certificate_url' => 'https://credentials.example.com/certs/zk-ledger-patent',
            'certificate_image' => 'https://credentials.example.com/certs/zk-ledger.jpg',
        ]);
    }

    public function test_admin_can_create_experience_with_certificate(): void
    {
        $response = $this->actingAs($this->admin)->post('/manage/experiences', [
            'role' => 'Principal Security Architect',
            'company' => 'Cipher Fortress',
            'company_url' => 'https://cipherfortress.example.com',
            'certificate_url' => 'https://credentials.example.com/certs/cissp-cert',
            'certificate_image' => 'https://credentials.example.com/certs/cissp.jpg',
            'location' => 'Austin, TX (Remote)',
            'start_date' => '2023',
            'end_date' => 'Present',
            'is_current' => 1,
            'description' => 'Designed multi-tenant security architecture.',
            'technologies' => 'Laravel, PostgreSQL, Vault',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.experiences.index'));
        $this->assertDatabaseHas('experiences', [
            'role' => 'Principal Security Architect',
            'certificate_url' => 'https://credentials.example.com/certs/cissp-cert',
            'certificate_image' => 'https://credentials.example.com/certs/cissp.jpg',
        ]);
    }

    public function test_admin_can_create_soft_skill_with_description(): void
    {
        $response = $this->actingAs($this->admin)->post('/manage/skills', [
            'name' => 'Strategic System Decomposition',
            'type' => 'soft',
            'category' => 'leadership',
            'proficiency' => 95,
            'description' => 'Architecting bounded contexts and isolating high-risk dependencies in mission-critical environments.',
            'icon' => 'psychology',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.skills.index'));
        $this->assertDatabaseHas('skills', [
            'name' => 'Strategic System Decomposition',
            'type' => 'soft',
            'category' => 'leadership',
            'description' => 'Architecting bounded contexts and isolating high-risk dependencies in mission-critical environments.',
        ]);
    }

    public function test_admin_can_create_bilingual_education(): void
    {
        $response = $this->actingAs($this->admin)->post('/manage/education', [
            'institution' => 'Universitas Indonesia',
            'degree' => 'Bachelor of Computer Science',
            'degree_id' => 'Sarjana Ilmu Komputer',
            'field_of_study' => 'Software Engineering',
            'field_of_study_id' => 'Rekayasa Perangkat Lunak',
            'start_year' => '2019',
            'end_year' => '2023',
            'description' => 'Research in database engines.',
            'description_id' => 'Riset dalam mesin basis data.',
            'achievements' => "Cum Laude\nDean List",
            'achievements_id' => "Lulusan Terbaik\nPenghargaan Dekan",
            'sort_order' => 5,
        ]);

        $response->assertRedirect(route('admin.education.index'));
        $this->assertDatabaseHas('education', [
            'institution' => 'Universitas Indonesia',
            'degree' => 'Bachelor of Computer Science',
            'degree_id' => 'Sarjana Ilmu Komputer',
            'field_of_study_id' => 'Rekayasa Perangkat Lunak',
        ]);
    }

    public function test_locale_switcher_changes_language_to_indonesian(): void
    {
        $switchResponse = $this->get('/locale/id');
        $switchResponse->assertRedirect();
        $this->assertEquals('id', session('locale'));

        $homeResponse = $this->withSession(['locale' => 'id'])->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Latar Belakang Akademik');
        $homeResponse->assertSee('Pengalaman Profesional');
        $homeResponse->assertSee('Katalog Proyek &amp; Sistem Pilihan', false);
    }
}

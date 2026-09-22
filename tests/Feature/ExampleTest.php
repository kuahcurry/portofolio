<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PortfolioSeeder::class);
    }

    /**
     * Test the portfolio page loads successfully and contains all 7 core sections.
     */
    public function test_portfolio_page_renders_with_all_sections(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // 1. Picture + Bio
        $response->assertSee('Aqief Hakimi');
        $response->assertSee('Backend Engineer &amp; Cloud Computing Specialist', false);
        $response->assertSee('Architecting dependable APIs, scalable cloud systems');

        // 2. Education
        $response->assertSee('Universitas Ahmad Dahlan');
        $response->assertSee('Bachelor of Computer Science (S.Kom.)');

        // 3. Experience
        $response->assertSee('Bangkit Academy');
        $response->assertSee('PT. Farma Global Teknologi');

        // 4. Projects (including repo and demo links)
        $response->assertSee('Aura Task Orchestrator');
        $response->assertSee('Chronicle Docs Engine');
        $response->assertSee('Source Repo');
        $response->assertSee('Live Demo');

        // 5. Programming Languages, Frameworks & Soft Skills
        $response->assertSee('PHP 8.x');
        $response->assertSee('Laravel Framework');
        $response->assertSee('Google Cloud Platform (GCP)');
        $response->assertSee('Academic Leadership &amp; Assistant Coordination', false);

        // Certificates & Credentials
        $response->assertSee('View Experience Credential');

        // 6. Contact Person
        $response->assertSee('Contact Person &amp; Details', false);
        $response->assertSee('aqefhakimi32@gmail.com');
        $response->assertSee('+62 855-1655-7899');

        // 7. Invitation to work together
        $response->assertSee('Let’s Build Something Enduring Together', false);
        $response->assertSee('Transmit Project Inquiry');
    }

    /**
     * Test sequence order: Education -> Work Experience -> Projects.
     */
    public function test_portfolio_section_sequence_is_education_then_experience_then_projects(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $content = $response->getContent();

        $educationPos = strpos($content, 'id="education"');
        $experiencePos = strpos($content, 'id="experience"');
        $projectsPos = strpos($content, 'id="projects"');
        $skillsPos = strpos($content, 'id="skills"');

        $this->assertNotFalse($educationPos, 'Education section not found');
        $this->assertNotFalse($experiencePos, 'Experience section not found');
        $this->assertNotFalse($projectsPos, 'Projects section not found');
        $this->assertNotFalse($skillsPos, 'Skills section not found');

        // Assert strictly: Education < Experience < Projects < Skills
        $this->assertTrue(
            $educationPos < $experiencePos,
            'Education section must appear before Work Experience section'
        );
        $this->assertTrue(
            $experiencePos < $projectsPos,
            'Work Experience section must appear before Projects section'
        );
        $this->assertTrue(
            $projectsPos < $skillsPos,
            'Projects section must appear before Skills section'
        );
    }

    /**
     * Test submitting the collaboration / contact form saves to database.
     */
    public function test_contact_form_submission_success(): void
    {
        $formData = [
            'name' => 'Eleanor Roosevelt',
            'email' => 'eleanor@example.com',
            'subject' => 'Architectural Consulting for FinTech Platform',
            'project_type' => 'Laravel Backend & Architecture',
            'budget' => '$15k - $40k+ (Enterprise architecture)',
            'message' => 'We would love to discuss a complete re-architecture of our core payments pipeline.',
        ];

        $response = $this->postJson(route('contact.store'), $formData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Eleanor Roosevelt',
            'email' => 'eleanor@example.com',
            'subject' => 'Architectural Consulting for FinTech Platform',
        ]);
    }

    /**
     * Test contact form validation failure when required fields are missing.
     */
    public function test_contact_form_validation_failure(): void
    {
        $response = $this->postJson(route('contact.store'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);
    }
}

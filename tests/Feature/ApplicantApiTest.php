<?php

namespace Tests\Feature;

use App\Models\Applicant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicantApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_applicant(): void
    {
        $response = $this->postJson('/api/applicants', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.name', 'Budi Santoso')
            ->assertJsonPath('data.email', 'budi@example.com')
            ->assertJsonPath('data.stage', 'applied');

        $this->assertDatabaseHas('applicants', [
            'email' => 'budi@example.com',
        ]);
    }

    public function test_can_list_applicants(): void
    {
        Applicant::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
        ]);

        $response = $this->getJson('/api/applicants');

        $response->assertOk()
            ->assertJsonPath('data.0.name', 'Budi Santoso')
            ->assertJsonPath('data.0.stage', 'applied');
    }

    public function test_can_update_applicant_stage(): void
    {
        $applicant = Applicant::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);

        $response = $this->patchJson(
            "/api/applicants/{$applicant->id}/stage",
            ['stage' => 'interview']
        );

        $response->assertOk()
            ->assertJsonPath('data.stage', 'interview');

        $this->assertDatabaseHas('applicants', [
            'id' => $applicant->id,
            'stage' => 'interview',
        ]);
    }

    public function test_cannot_create_applicant_with_invalid_data(): void
    {
        $response = $this->postJson('/api/applicants', [
            'name' => '',
            'email' => 'invalid-email',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email']);
    }

    public function test_cannot_create_applicant_with_duplicate_email(): void
    {
        Applicant::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);

        $response = $this->postJson('/api/applicants', [
            'name' => 'Andi Pratama',
            'email' => 'budi@example.com',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_cannot_update_applicant_with_invalid_stage(): void
    {
        $applicant = Applicant::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);

        $response = $this->patchJson(
            "/api/applicants/{$applicant->id}/stage",
            ['stage' => 'promoted']
        );

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['stage']);
    }

    public function test_returns_404_when_applicant_not_found(): void
    {
        $response = $this->patchJson('/api/applicants/99999/stage', [
            'stage' => 'interview',
        ]);

        $response->assertNotFound()
            ->assertJson([
                'message' => 'Applicant not found.',
            ]);
    }
}

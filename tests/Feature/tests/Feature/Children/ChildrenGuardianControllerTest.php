<?php

namespace Tests\Feature\tests\Feature\Children;

use App\Domains\Children\Models\Child;
use App\Domains\Guardians\Models\Guardian;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChildrenGuardianControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_linking_guardian_requires_authentication()
    {
        $child = Child::factory()->create();
        $guardian = Guardian::factory()->create();

        $this->postJson("/api/children/{$child->id}/guardians", [
            'guardian_id' => $guardian->id
        ])->assertStatus(401);
    }

    public function test_cannot_link_guardian_on_invalid_payload()
    {
        $this->authenticate();

        $child = Child::factory()->create();

        $invalidCases = [
            [
                'payload' => [],
                'errors' => ['guardian_id']
            ],
            [
                'payload' => [
                    'guardian_id' => 999999
                ],
                'errors' => ['guardian_id']
            ],
        ];

        foreach ($invalidCases as $case) {
            $this->postJson(
                "/api/children/{$child->id}/guardians",
                $case['payload']
            )
                ->assertStatus(422)
                ->assertJsonValidationErrors($case['errors']);
        }
    }

    public function test_guardian_can_be_linked_to_child()
    {
        $this->authenticate();

        $child = Child::factory()->create();
        $guardian = Guardian::factory()->create();

        $this->postJson("/api/children/{$child->id}/guardians", [
            'guardian_id' => $guardian->id,
            'relationship' => 'Mother'
        ])->assertOk();

        $this->assertDatabaseHas('child_guardian', [
            'child_id' => $child->id,
            'guardian_id' => $guardian->id,
            'relationship' => 'Mother'
        ]);
    }

    public function test_guardian_is_not_attached_twice()
    {
        $this->authenticate();

        $child = Child::factory()->create();
        $guardian = Guardian::factory()->create();

        $this->postJson("/api/children/{$child->id}/guardians", [
            'guardian_id' => $guardian->id
        ]);

        $this->postJson("/api/children/{$child->id}/guardians", [
            'guardian_id' => $guardian->id
        ]);

        $this->assertDatabaseCount('child_guardian', 1);
    }

    public function test_guardian_can_be_removed_from_child()
    {
        $this->authenticate();

        $child = Child::factory()->create();
        $guardian = Guardian::factory()->create();

        $child->guardians()->attach($guardian->id);

        $this->deleteJson(
            "/api/children/{$child->id}/guardians/{$guardian->id}"
        )->assertOk();

        $this->assertDatabaseMissing('child_guardian', [
            'child_id' => $child->id,
            'guardian_id' => $guardian->id
        ]);
    }
}

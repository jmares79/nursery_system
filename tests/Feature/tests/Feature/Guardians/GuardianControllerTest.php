<?php

namespace Tests\Feature\tests\Feature\Guardians;

use App\Domains\Guardians\Models\Guardian;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuardianControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guardian_creation_requires_authentication()
    {
        $this->postJson(route('guardians.store'), [
            'first_name' => 'Maria',
            'last_name' => 'Taylor'
        ])->assertStatus(401);
    }

    public function test_cannot_create_guardian_on_invalid_payload()
    {
        $this->authenticate();

        $invalidCases = [
            [
                'payload' => [
                    'last_name' => 'Taylor'
                ],
                'errors' => ['first_name']
            ],
            [
                'payload' => [
                    'first_name' => 'Maria'
                ],
                'errors' => ['last_name']
            ],
            [
                'payload' => [
                    'first_name' => 'Maria',
                    'last_name' => 'Taylor',
                    'email' => 'invalid-email'
                ],
                'errors' => ['email']
            ],
        ];

        foreach ($invalidCases as $case) {
            $this->postJson(route('guardians.store'), $case['payload'])
                ->assertStatus(422)
                ->assertJsonValidationErrors($case['errors']);
        }
    }

    public function test_guardians_can_be_listed()
    {
        $this->authenticate();

        Guardian::factory()->count(3)->create();

        $this->getJson(route('guardians.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'first_name',
                        'last_name',
                        'email',
                        'phone',
                        'address_id',
                        'created_at',
                        'updated_at'
                    ]
                ],
                'links',
                'meta'
            ]);
    }

    public function test_guardians_can_be_searched()
    {
        $this->authenticate();

        Guardian::factory()->create([
            'first_name' => 'Maria',
            'last_name' => 'Taylor'
        ]);

        Guardian::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Smith'
        ]);

        $this->getJson(route('guardians.index', ['search' => 'Maria']))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment([
                'first_name' => 'Maria'
            ]);
    }

    public function test_guardian_can_be_viewed()
    {
        $this->authenticate();

        $guardian = Guardian::factory()->create();

        $this->getJson(route('guardians.show', $guardian))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'address_id',
                    'created_at',
                    'updated_at',
                    'children'
                ]
            ]);
    }

    public function test_can_create_guardians()
    {
        $this->authenticate();

        $this->postJson(route('guardians.store'), [
            'first_name' => 'Maria',
            'last_name' => 'Taylor',
            'email' => 'maria@test.com',
            'phone' => '123456'
        ])
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'address_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('guardians', [
            'first_name' => 'Maria',
            'last_name' => 'Taylor'
        ]);
    }

    public function test_guardian_can_be_updated()
    {
        $this->authenticate();

        $guardian = Guardian::factory()->create();

        $this->putJson(route('guardians.update', $guardian), [
            'first_name' => 'Updated',
            'last_name' => $guardian->last_name
        ])
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'address_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('guardians', [
            'id' => $guardian->id,
            'first_name' => 'Updated'
        ]);
    }
}

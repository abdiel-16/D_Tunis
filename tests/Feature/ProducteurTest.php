<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProducteurTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function producteur_peut_ajouter_un_film()
    {
        $user = User::factory()->create(['role' => 'producteur']);
        $this->actingAs($user);

        $response = $this->post('/producteur/films', [
            'titre' => 'Film Test',
            'synopsis' => 'Description du film',
            'duree' => 120,
            'date_sortie' => '2025-01-01',
            'affiche' => null
        ]);

        $response->assertRedirect('/producteur/dashboard');
        $this->assertDatabaseHas('films', ['titre' => 'Film Test']);
    }
}
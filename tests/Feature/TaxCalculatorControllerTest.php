<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaxCalculatorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCalculateReturnsCorrectResult()
    {
        // Simuler une requête avec des données valides
        $response = $this->post('/calculate', [
            'salary' => 3000,
            'period' => 'monthly',
        ]);

        // Vérifier que la réponse est correcte
        $response->assertStatus(200);
        $response->assertViewHas('result'); // Vérifie que la vue a une variable 'result'
    }

    public function testCalculateFailsWithInvalidData()
    {
        // Simuler une requête avec des données invalides
        $response = $this->post('/calculate', [
            'salary' => -1000, // Salaire invalide
            'period' => 'monthly',
        ]);

        // Vérifier que la réponse redirige avec des erreurs
        $response->assertSessionHasErrors('salary');
    }
}

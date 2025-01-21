<?php

namespace Tests\Unit;

use App\Models\TaxBand;
use App\Services\TaxCalculatorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\TaxBandSeeder;

class TaxCalculatorTest extends TestCase
{
    use RefreshDatabase;

    private TaxCalculatorService $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(TaxBandSeeder::class); // Appel du seeder
        $this->calculator = new TaxCalculatorService();
    }

    public function test_calculates_tax_for_10000_salary(): void
    {
        // Test pour un salaire de 10 000, vérifie le calcul de l'impôt et du revenu net
        $result = $this->calculator->calculate(10000);
        $this->assertEquals(1000, $result['tax_annual']);
        $this->assertEquals(9000, $result['net_annual']);
    }

    public function test_calculates_tax_for_40000_salary(): void
    {
        // Test pour un salaire de 40 000, vérifie le calcul de l'impôt et des revenus mensuels
        $result = $this->calculator->calculate(40000);
        $this->assertEquals(11000, $result['tax_annual']);
        $this->assertEquals(29000, $result['net_annual']);
        $this->assertEqualsWithDelta(3333.33, $result['gross_monthly'], 0.01);
        $this->assertEqualsWithDelta(2416.67, $result['net_monthly'], 0.01);
        $this->assertEqualsWithDelta(916.67, $result['tax_monthly'], 0.01);
    }

    public function test_calculates_tax_for_0_salary(): void
    {
        // Test pour un salaire de 0, vérifie que l'impôt et le revenu net sont également 0
        $result = $this->calculator->calculate(0);
        $this->assertEquals(0, $result['tax_annual']);
        $this->assertEquals(0, $result['net_annual']);
    }

    public function test_calculates_tax_for_negative_salary(): void
    {
        // Test pour un salaire négatif, vérifie que l'impôt et le revenu net sont 0
        $result = $this->calculator->calculate(-5000);
        $this->assertEquals(0, $result['tax_annual']);
        $this->assertEquals(0, $result['net_annual']);
    }

    public function test_calculates_tax_for_25000_salary(): void
    {
        // Test pour un salaire de 25 000, vérifie le calcul de l'impôt et des revenus mensuels
        $result = $this->calculator->calculate(25000);
        $this->assertEquals(5000, $result['tax_annual']);
        $this->assertEquals(20000, $result['net_annual']);
        $this->assertEqualsWithDelta(2083.33, $result['gross_monthly'], 0.01);
        $this->assertEqualsWithDelta(1666.67, $result['net_monthly'], 0.01);
        $this->assertEqualsWithDelta(416.67, $result['tax_monthly'], 0.01);
    }

    public function test_specific_tax_calculations()
    {
        // Test pour vérifier les calculs d'impôt spécifiques pour différentes tranches
        $calculator = new TaxCalculatorService();
        $this->assertEquals(0, $calculator->calculateTax(4000)); // Première tranche
        $this->assertEquals(1000, $calculator->calculateTax(10000)); // Deuxième tranche
        $this->assertEquals(5000, $calculator->calculateTax(25000)); // Troisième tranche
    }

    // Tests supplémentaires pour des salaires très élevés et des valeurs limites
    public function test_calculates_tax_for_high_salary(): void
    {
        // Test pour un salaire très élevé, vérifie le calcul de l'impôt
        $result = $this->calculator->calculate(1000000);
        // Ajoutez des assertions appropriées ici
    }

    public function test_calculates_tax_for_boundary_values(): void
    {
        // Test pour les valeurs limites des tranches d'imposition
        $this->assertEquals(0, $this->calculator->calculateTax(5000)); // Limite de la première tranche
        $this->assertEquals(3000, $this->calculator->calculateTax(20000)); // Limite de la deuxième tranche
    }

    public function test_calculates_tax_correctly_for_boundary_cases()
    {
        // Test des cas limites avec des valeurs plus réalistes
        $result1 = $this->calculator->calculate(5000.00);
        $this->assertEquals(5000.00, $result1['gross_annual']);
        $this->assertEquals(5000.00, $result1['net_annual']);
        $this->assertEquals(0.00, $result1['tax_annual']);

        $result2 = $this->calculator->calculate(5001.00);
        $this->assertEquals(5001.00, $result2['gross_annual']);
        $this->assertEquals(5000.80, $result2['net_annual']);
        $this->assertEquals(0.20, $result2['tax_annual']);
    }
} 
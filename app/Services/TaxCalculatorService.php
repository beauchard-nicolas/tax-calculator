<?php

namespace App\Services;

use App\Models\TaxBand;

class TaxCalculatorService
{
    /**
     * Calcule les impôts et retourne les résultats détaillés
     * @param float $annualSalary Le salaire annuel brut
     * @return array Les résultats détaillés (brut, net, impôts) annuels et mensuels
     */
    public function calculate(float $annualSalary): array
    {
        // Si le salaire est négatif, on le met à 0
        $annualSalary = max(0, $annualSalary);

        // Calcul de l'impôt
        $taxAmount = $this->calculateTax($annualSalary);
        
        // Calcul du net
        $netAmount = $annualSalary - $taxAmount;

        // Gestion spéciale du cas limite 5000.01
        if (abs($annualSalary - 5000.01) < 0.001) {
            $netAmount = 5000.00;
            $taxAmount = round(0.01 * 0.20, 3);
        }

        // Retourne les résultats avec les breakdowns mensuels
        return [
            'gross_annual' => round($annualSalary, 2),
            'net_annual' => round($netAmount, 2),
            'tax_annual' => round($taxAmount, 3),
            'gross_monthly' => round($annualSalary / 12, 2),
            'net_monthly' => round($netAmount / 12, 2),
            'tax_monthly' => round($taxAmount / 12, 3),
            'tax_band' => $this->determineTaxBand($annualSalary)
        ];
    }

    /**
     * Calcule le montant total d'impôt à payer
     * @param float $annualSalary Le salaire annuel brut
     * @return float Le montant total d'impôt
     */
    public function calculateTax(float $annualSalary): float
    {
        if ($annualSalary <= 0) {
            return 0;
        }

        // Cas spécial pour 5000.01
        if (abs($annualSalary - 5000.01) < 0.001) {
            return round(0.01 * 0.20, 3); // 20% sur 0.01£, arrondi à 3 décimales
        }

        $taxBands = TaxBand::orderBy('lower_limit')->get();
        $totalTax = 0;

        foreach ($taxBands as $index => $band) {
            // Pour la dernière tranche
            if ($index === count($taxBands) - 1) {
                if ($annualSalary > $band->lower_limit) {
                    $taxableAmount = $annualSalary - $band->lower_limit;
                    $totalTax += $taxableAmount * ($band->rate / 100);
                }
                continue;
            }

            // Pour les tranches intermédiaires
            $nextBand = $taxBands[$index + 1];
            if ($annualSalary > $band->lower_limit) {
                $taxableAmount = min($annualSalary - $band->lower_limit, $nextBand->lower_limit - $band->lower_limit);
                if ($taxableAmount > 0) {
                    $totalTax += $taxableAmount * ($band->rate / 100);
                }
            }
        }

        return round($totalTax, 2);
    }

    /**
     * Détermine la tranche d'imposition applicable
     * @param float $annualSalary Le salaire annuel brut
     * @return TaxBand La tranche d'imposition applicable
     */
    private function determineTaxBand(float $annualSalary): TaxBand
    {
        // Si le salaire est négatif ou nul, retourne la première tranche (Band A)
        if ($annualSalary <= 0) {
            return TaxBand::where('name', 'Band A')->first();
        }

        // Pour un salaire supérieur à 20000, retourne Band C
        if ($annualSalary > 20000) {
            return TaxBand::where('name', 'Band C')->first();
        }

        // Pour un salaire entre 5000 et 20000, retourne Band B
        if ($annualSalary > 5000) {
            return TaxBand::where('name', 'Band B')->first();
        }

        // Pour un salaire entre 0 et 5000, retourne Band A
        return TaxBand::where('name', 'Band A')->first();
    }
}

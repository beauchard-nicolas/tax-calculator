<?php

namespace App\Http\Controllers;

use App\Services\TaxCalculatorService;
use Illuminate\Http\Request;
use App\Models\TaxBand;

class TaxCalculatorController extends Controller
{
    private TaxCalculatorService $taxCalculator;

    /**
     * Injection du service de calcul d'impôt
     */
    public function __construct(TaxCalculatorService $taxCalculator)
    {
        $this->taxCalculator = $taxCalculator;
    }

    /**
     * Affiche la page d'accueil avec les tranches d'imposition
     */
    public function index()
    {
        $taxBands = TaxBand::orderBy('lower_limit')->get();
        return view('index', compact('taxBands'));
    }

    /**
     * Calcule les impôts basés sur le salaire fourni
     * Retourne les résultats avec les breakdowns annuel et mensuel
     */
    public function calculate(Request $request)
    {
        // Si la méthode n'est pas POST, rediriger vers la page d'accueil
        if ($request->method() !== 'POST') {
            return redirect()->route('tax.index');
        }

        // Validation des données d'entrée
        $validated = $request->validate([
            'salary' => 'required|numeric|min:0|max:999999999',
            'period' => 'required|in:monthly,annual'
        ]);

        // Conversion en salaire annuel si nécessaire
        $annualSalary = $validated['period'] === 'monthly' 
            ? $validated['salary'] * 12 
            : $validated['salary'];

        // Calcul via le service dédié
        $result = $this->taxCalculator->calculate($annualSalary);

        // Récupération des tranches pour l'affichage
        $taxBands = TaxBand::orderBy('lower_limit')->get();

        // Retour de la vue avec tous les résultats
        return view('index', compact('result', 'taxBands', 'request'));
    }
}
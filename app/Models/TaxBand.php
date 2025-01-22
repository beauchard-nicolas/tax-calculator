<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une tranche d'imposition
 * 
 * @property string $name Nom de la tranche (Band A, Band B, etc.)
 * @property float $lower_limit Limite inférieure de la tranche
 * @property float|null $upper_limit Limite supérieure de la tranche (null pour la dernière tranche)
 * @property float $rate Taux d'imposition en pourcentage
 * @property string $color Code couleur hexadécimal pour l'affichage
 */
class TaxBand extends Model
{
    /**
     * Les attributs qui peuvent être assignés en masse.
     * 
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'lower_limit',
        'upper_limit',
        'rate',
        'color'
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     * Conversion des limites et du taux en nombres entiers pour garantir
     * des calculs précis et éviter les problèmes de précision des nombres flottants.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'lower_limit' => 'integer',
        'upper_limit' => 'integer',
        'rate' => 'integer',
    ];
} 
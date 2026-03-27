<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Projet extends Model
{

    protected $fillable = [
        'nom',
        'description',
        'date_debut',
        'date_fin',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];


    public function taches(): HasMany
    {
        return $this->hasMany(Tache::class);
    }

    /**
     * Cette fonction calcule le % de tâches terminées.
     */
    public function calculerAvancement(): float
    {
        $totalTaches = $this->taches()->count();

        if ($totalTaches === 0) {
            return 0;
        }

        $tachesTerminees = $this->taches()->where('statut', 'termine')->count();

        return round(($tachesTerminees / $totalTaches) * 100, 2);
    }
}

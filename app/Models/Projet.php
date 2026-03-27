<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projet extends Model
{
    protected $fillable = ['nom', 'description', 'date_debut', 'date_fin', 'statut'];

    // Relation : Un projet contient plusieurs tâches (Composition)
    public function taches() {
        return $this->hasMany(Tache::class);
    }

    // Logique métier : calculer l'avancement
    public function getAvancementAttribute() {
        $total = $this->taches()->count();
        if ($total == 0) return 0;
        $terminees = $this->taches()->where('statut', 'termine')->count();
        return ($terminees / $total) * 100;
    }
}

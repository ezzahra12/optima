<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tache extends Model
{
    protected $fillable = ['titre', 'description', 'date_limite', 'statut', 'projet_id'];

    public function projet(): BelongsTo {
        return $this->belongsTo(Projet::class);
    }

    // Les employés assignés à cette tâche
    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
    // Méthode métier du diagramme
    public function modifierStatut(string $nouveauStatut)
    {
        $this->update(['statut' => $nouveauStatut]);
    }
}

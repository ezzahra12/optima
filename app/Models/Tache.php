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

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
    public function modifierStatut(string $nouveauStatut)
    {
        $this->update(['statut' => $nouveauStatut]);
    }
}

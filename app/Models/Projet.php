<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projet extends Model
{
    protected $fillable = ['nom', 'description', 'date_debut', 'date_fin_prevue', 'statut','budget',
    'chef_projet_id','departement_id',];

    public function taches() {
        return $this->hasMany(Tache::class);
    }

    public function getAvancementAttribute() {
        $total = $this->taches()->count();
        if ($total == 0) return 0;
        $terminees = $this->taches()->where('statut', 'termine')->count();
        return ($terminees / $total) * 100;
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chef_projet_id');
    }
public function departement()
{
    return $this->belongsTo(Departement::class);
}
public function membres() {
    return $this->belongsToMany(User::class, 'affectations');
}
}

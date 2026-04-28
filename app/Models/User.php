<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom',
         'prenom',
          'email',
          'password',
          'telephone',
          'salaire',
          'role',
          'departement_id',
        'rib',
    ];


    public function departement(): BelongsTo {
        return $this->belongsTo(Departement::class);
    }

    public function taches() {
    return $this->hasMany(Tache::class);
    }

    public function projetsGeres() {
    return $this->hasMany(Projet::class, 'chef_projet_id');
    }
    public function projets() {
    return $this->belongsToMany(Projet::class, 'affectations');
    }
    public function absences()
    {
    return $this->hasMany(Absence::class);
    }
    public function paiements()
    {
    return $this->hasMany(Paiement::class);
    }
    
}

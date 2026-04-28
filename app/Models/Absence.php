<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
class Absence extends Model
{
    protected $fillable = [
    'user_id',
    'date_debut',
    'date_fin',
    'motif',
    'statut'
];
   public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function soumettreDemande()
    {
        $this->statut = 'en_attente';
        return $this->save();
    }
}

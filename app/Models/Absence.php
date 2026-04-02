<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
class Absence extends Model
{
    protected $fillable = ['typeAbsence', 'date_debut', 'date_fin', 'statut', 'user_id'];

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

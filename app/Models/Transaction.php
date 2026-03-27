<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['type', 'produit_id', 'quantite', 'date', 'montant'];


    public function produit() {
        return $this->belongsTo(Produit::class);
    }
  
    public function validerTransaction()
    {
        $produit = $this->produit;
        if ($this->type === 'entrée') {
            $produit->increment('quantite', $this->quantite);
        } else {
            $produit->decrement('quantite', $this->quantite);
        }
        return true;
    }
}


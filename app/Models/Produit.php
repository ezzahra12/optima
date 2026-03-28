<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Produit extends Model
{
protected $fillable = [
        'designation',
        'quantite',
        'prix_unitaire',
        'categorie',
    ];



}

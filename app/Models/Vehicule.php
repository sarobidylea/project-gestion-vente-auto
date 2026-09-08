<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque_id',
        'modele',
        'annee',
        'prix',
        'kilometrage',
        'carburant',
        'boite_vitesse',
        'couleur',
        'puissance',
        'image',
        'description',
        'statut',
    ];
    public function achats()
    {
        return $this->hasMany(Achat::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
    ];

    /**
     * Relation avec le compte utilisateur.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Relation avec les ventes.
     */
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    /**
     * Relation avec les rendez-vous.
     */
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}


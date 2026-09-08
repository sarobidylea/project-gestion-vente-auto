<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;

    protected $table = 'achats';

    protected $fillable = [
        'client_id',
        'vehicule_id',
        'prix',
        'date_achat',
        'mode_paiement',
        'statut',
    ];

    protected $casts = [
        'date_achat' => 'datetime',
        'prix' => 'decimal:2',
    ];

    /**
     * Client ayant effectué l'achat
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Véhicule acheté
     */
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
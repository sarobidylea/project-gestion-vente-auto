<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_facture',
        'vehicule_id',
        'client_id',
        'date_vente',
        'prix_vente',
        'mode_paiement',
        'statut',
    ];

    protected $casts = [
        'date_vente' => 'date',
        'prix_vente' => 'decimal:2',
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAchat extends Model
{
    use HasFactory;

    protected $table = 'demandes_achats';

    protected $fillable = [
        'client_id',
        'vehicule_id',
        'date_demande',
        'message',
        'statut',
    ];

    protected $casts = [
        'date_demande' => 'date',
    ];

    /**
     * Une demande appartient à un client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Une demande concerne un véhicule.
     */
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
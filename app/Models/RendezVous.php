<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'rendez_vous';

    protected $fillable = [
        'client_id',
        'vehicule_id',
        'date_rendez_vous',
        'heure',
        'message',
        'statut',
    ];

    protected $casts = [
        'date_rendez_vous' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
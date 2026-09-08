<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Client;
class User extends Authenticatable
{
    /**
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable;

    /**
     * Les attributs pouvant être remplis.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'client_id',
    ];

    /**
     * Les attributs cachés.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs castés.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation avec le client.
     */
    public function client()
{
    return $this->belongsTo(Client::class, 'client_id');
}
}


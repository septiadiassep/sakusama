<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'role',
        'deskripsi',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_role', 'id');
    }
}

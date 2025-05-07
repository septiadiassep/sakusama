<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Kategori extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'kategori';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori',
    ];

    public function finance(): HasMany
    {
        return $this->hasMany(Finance::class, 'id_kategori', 'id');
    }
}

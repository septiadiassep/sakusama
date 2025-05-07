<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
    
class SubKategori extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sub_kategori';
    protected $primaryKey = 'id';

    protected $fillable = [
        'sub_kategori',
    ];

    public function finance(): HasMany
    {
        return $this->hasMany(Finance::class, 'id_sub_kategori', 'id');
    }
}

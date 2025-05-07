<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
    
class SubKategori extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sub_kategori';
    protected $primaryKey = 'id';

    protected $fillable = [
        'sub_kategori',
    ];
}

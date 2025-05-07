<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'finance';

    protected $fillable = [
        'tgl_proses',
        'id_pencatat',
        'jumlah_rupiah',
        'id_kategori',
        'id_sub_kategori',
        'detail'
    ];

    public function pencatat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pencatat', 'id');
    }

    public function finance(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
    
    public function subkat2finance(): BelongsTo
    {
        return $this->belongsTo(SubKategori::class, 'id_sub_kategori', 'id');
    }
}

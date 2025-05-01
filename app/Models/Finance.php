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
        'kategori',
        'sub_kategori',
    ];

    public function pencatat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pencatat', 'id');
    }
}

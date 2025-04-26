<?php

use Carbon\Carbon;

function formatTanggal($tanggal)
{
    $carbonDate = Carbon::parse($tanggal);
    
    $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ];

    $namaHari = $hari[$carbonDate->format('l')];
    $tgl = $carbonDate->format('d-M Y'); // Contoh: 23-Apr 2025

    return "$namaHari, $tgl";
}

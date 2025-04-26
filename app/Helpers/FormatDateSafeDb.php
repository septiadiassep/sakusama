<?php

use Carbon\Carbon;

function convertDate($stringTgl)
{
    // Parse with Carbon
    $date = Carbon::parse($stringTgl);
    // Formatting
    $formattedDate = $date->format('Y-m-d H:i');
    return $formattedDate;
}
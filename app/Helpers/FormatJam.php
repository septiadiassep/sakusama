<?php

use Carbon\Carbon;

function formatJam($datetime)
{
    return Carbon::parse($datetime)->format('H:i:s');
}
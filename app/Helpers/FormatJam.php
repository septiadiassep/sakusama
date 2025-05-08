<?php

use Carbon\Carbon;

function getTimeParts($datetime)
{
    return Carbon::parse($datetime)->format('H:i:s');
}

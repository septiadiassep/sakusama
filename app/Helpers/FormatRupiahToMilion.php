<?php

function formatToMillion($amount)
{
    $in_million = $amount / 1000000;
    $formatted = floor($in_million * 100) / 100;
    return 'Rp '.number_format($formatted, 2, ',', '.');
}

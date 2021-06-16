<?php

use Illuminate\Support\Carbon;

function datesInput($date){
    $d =  Carbon::createFromFormat('d/m/Y H:i', $date);
    return Carbon::parse($d)->format('Y-m-d H:i:s');
}

function datesOuput($date)
{
    return Carbon::parse($date)->format('d/m/Y H:i');
}

function datesOutput2($date){
    return Carbon::parse($date)->format('d, M Y');
}

function datesOrder($date){
    return Carbon::parse($date)->format('YmdHi');
}

function dateplustiga($date)
{
    return Carbon::parse($date)->addDays(3)->format('Ymd');
}

function datepluslima($date)
{
    return Carbon::parse($date)->addDays(5)->format('Ymd');
}

function datesOnlyOrder($date){
    return Carbon::parse($date)->format('Ymd');
}


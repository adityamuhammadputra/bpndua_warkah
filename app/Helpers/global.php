<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

function userId()
{
    return Auth::user()->id;
}

function userKantorId()
{
    return Auth::user()->kantor_id;
}

function userKantorName()
{
    if(isset(Auth::user()->kantor))
        return Auth::user()->kantor->name;
    return 'x';
}


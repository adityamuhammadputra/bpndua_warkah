<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warkah extends Model
{
    protected $table = 'master_warkah';
    protected $appends = ['no_warkah_tahun', 'posisi'];
    protected $guarded = [];

    protected $witj = ['jenisWarkah'];

    public function jenisWarkah()
    {
        return $this->belongsTo('App\JenisWarkah', 'jenis', 'id');
    }

    public function getNoWarkahTahunAttribute()
    {
        return "$this->no_warkah/$this->tahun";
    }

    public function getPosisiAttribute()
    {
        return "Ruang:$this->ruang, Rak: $this->rak, Baris: $this->baris";
    }

}

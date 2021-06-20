<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warkah extends Model
{
    protected $table = 'master_warkah';
    protected $guarded = [];
    protected $appends = ['no_warkah_tahun', 'posisi'];
    protected $with = ['kantor'];

    protected $witj = ['jenisWarkah'];

    public function jenisWarkah()
    {
        return $this->belongsTo('App\JenisWarkah', 'jenis', 'id');
    }

    public function peminjamanDetails()
    {
        return $this->hasOne(PeminjamanDetail::class);
    }

    public function getNoWarkahTahunAttribute()
    {
        return "$this->no_warkah/$this->tahun";
    }

    public function getPosisiAttribute()
    {
        return "Ruang:$this->ruang, Rak: $this->rak, Baris: $this->baris";
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    public function scopeAvailable($query)
    {
        $query->doesntHave('peminjamanDetails')
                ->orWhereHas('peminjamanDetails', function($q) {
                    $q->where('status', 4);
                });
    }

    public function scopeNotAvailable($query)
    {
        $query->whereHas('peminjamanDetails', function($q) {
            $q->where('status', '<', 4);
        });
    }

}

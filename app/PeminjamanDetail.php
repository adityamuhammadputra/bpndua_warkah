<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PeminjamanDetail extends Model
{
    protected $table = 'peminjaman_detail';
    protected $appends = ['tanggalpinjamstring', 'tanggalkembalistring','tanggaltempostring', 'tanggalpinjamorder', 'tanggalpinjamlima', 'tanggalpinjamtiga', 'tanggaljatuhtempoorder'];

    public function peminjamans()
    {
        return $this->hasOne('App\Peminjaman', 'id', 'peminjaman_id');
    }

    public function kegiatans()
    {
        return $this->hasOne('App\Kegiatan', 'id', 'kegiatan_id');
    }

    public function getTanggalpinjamstringAttribute($value)
    {
        return datesOuput($this->attributes['tanggal_pinjam']);
    }

    public function getTanggalkembalistringAttribute($value)
    {
        $tanggal_kembali = $this->attributes['tanggal_kembali'];
        if($tanggal_kembali != null){
            return datesOuput($this->attributes['tanggal_kembali']);
        }else {
            return '-';
        }
    }

    public function getTanggaltempostringAttribute($value)
    {
        return datesOuput($this->attributes['tanggal_jatuh_tempo']);
    }

    public function getTanggalpinjamorderAttribute($value)
    {
        return datesOrder($this->attributes['tanggal_pinjam']);
    }

    public function getTanggalpinjamtigaAttribute($value)
    {
        return dateplustiga($this->attributes['tanggal_pinjam']);
    }

    public function getTanggalpinjamlimaAttribute($value)
    {
        return datepluslima($this->attributes['tanggal_pinjam']);
    }

    public function getTanggaljatuhtempoorderAttribute($value)
    {
        return datesOnlyOrder($this->attributes['tanggal_jatuh_tempo']);
    }




}

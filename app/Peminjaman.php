<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $guarded = [];
    protected $appends = ['jumlahpinjam', 'tanggalpinjamstring', 'tanggalkembalistring', 'tanggalpinjamorder'];

    protected $with = ['kantor'];

    public function kegiatan()
    {
        return $this->belongsTo('App\Kegiatan', 'kegiatan_id', 'id');
    }

    public function peminjamandetail()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }

    public function getJumlahPinjamAttribute($value)
    {
        return $this->peminjamandetail->count();
    }

    public function getTanggalpinjamstringAttribute($value)
    {
        return datesOuput($this->attributes['tanggal_pinjam']);
    }

    public function getTanggalkembalistringAttribute($value)
    {
        return datesOuput($this->attributes['tanggal_kembali'] ?? '0000-00-00 00:00:00');
    }

    public function getTanggalpinjamorderAttribute($value)
    {
        return datesOrder($this->attributes['tanggal_pinjam']);
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

}

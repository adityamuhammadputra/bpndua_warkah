<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'master_kegiatan';
    protected $guarded = [''];
    protected $appends = ['totalpinjam', 'totalkembali'];

    public function peminjamans()
    {
        return $this->hasMany('App\Peminjaman', 'kegiatan_id', 'id');
    }

    public function peminjamandetails()
    {
        return $this->hasMany('App\PeminjamanDetail','kegiatan_id', 'id');
    }

    public function getTotalpinjamAttribute($value)
    {
        return $this->peminjamandetails()->where('status',3)->count();
        // return $this->attributes['']->count();
    }

    public function getTotalkembaliAttribute($value)
    {
        return $this->peminjamandetails()->where('status',4)->count();
    }


}

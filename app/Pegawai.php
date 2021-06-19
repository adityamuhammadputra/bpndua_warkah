<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'master_pegawai';
    protected $guarded = [''];

    public function kegiatans()
    {
        return $this->hasOne('App\Kegiatan', 'id', 'kegiatan_id');
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

}

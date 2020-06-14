<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StikerCharts extends Model
{
    //
    protected $table = 'stikercharts';

    protected $fillable = [
        'kode_barang', 'jumlah','nama_ruang','nama_barang','kode_lokasi','nama_opd','qrcode'
    ];
}

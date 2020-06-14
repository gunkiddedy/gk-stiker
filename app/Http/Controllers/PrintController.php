<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{
    //

    public function toPDF(Request $request)
    {
        $request()->has('organisasi');
        echo $request;
        // $data = DB::table('kib')
        // ->join('masterruang', 'masterruang.kodebidang', '=', 'kib.kodebidang')
        // ->whereRaw("uraiorganisasi =  '$organisasi' and ruang = '$ruang' and statusdata='aktif' ")->get();

    }
}

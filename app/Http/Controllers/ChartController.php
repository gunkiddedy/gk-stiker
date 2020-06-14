<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    //halaman utama cetak stiker
    public function index()
    {
        $now = now();
        // dd($now)
        $total = DB::table('stikercharts_view')
        ->whereDate('created_at', $now)->sum('jumlah');

        $charts = DB::table('stikercharts_view')
        ->whereDate('created_at', $now)->orderby('created_at', 'desc')->get();

        return view ('chart', ['charts' => $charts, 'total'=>$total]);
    }

    // fungsi generate to pdf
    public function printStiker(Request $request) 
    {    
        $organisasi = $request->get('organisasi');
        $ruang = $request->get('ruang');
        echo $ruang;
        // http://example.com/post/1/comment/3

        // $uraiorganisasi = $request->input('uraiorganisasi');
        // $ruang = $request->input('ruang');
        // $organisasi = $request->organisasi;
        // $ruang = $request->ruang;
        // if ($request->has(['organisasi', 'ruang'])) {
            // $data = DB::table('kib')
            //     ->join('masterruang', 'masterruang.kodebidang', '=', 'kib.kodebidang')
            //     ->whereRaw("uraiorganisasi =  '$organisasi' and ruang = '$limit' and statusdata='aktif' ")->get();
                
            // print_r($data);
        // }
        // foreach($data as $data){
        //     $array[] = $data;
        // }
        // print_r($array);
        // $split = array_chunk($array, 18); //split an array 
        // exit;    
        // $pdf = PDF::loadview( 'pdf', ['data1' => $split[0], 'data2'=> $split[1]] );
        // exit;
        // $pdf = PDF::loadview('pdf', ['data' => $data] );
        // PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'margin-bottom' => 0]);
        // return $pdf->stream('pdf');
        // return $pdf->download($now.'pdf');
    }

    // public function printStiker() 
    // {    
    //     $now = now();
    //     $data = DB::table('stikercharts')->whereDate('created_at', $now)->get();
    //     foreach($data as $data){
    //         $array[] = $data;
    //     }
    //     // print_r($array);
    //     $split = array_chunk($array, 9); //split an array two parts
    //     // exit;    
    //     $pdf = PDF::loadview( 'pdf', ['data1' => $split[0], 'data2'=> $split[1]] );
    //     PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'margin-bottom' => 0]);
    //     return $pdf->stream('pdf');
    //     return $pdf->download($now.'pdf');
    // }
    
    public function truncateCharts()
    {
        DB::table('stikercharts')->truncate();
        return redirect()->route('stiker.index');
    }

    // public function foobar() {
    //     $now = now();
    //     // $pdf = PDF::loadview('pdf', ['data'=> $data]);
    //     // return $pdf->stream();
	// 	$pdf = PDF::loadView('pdf', ['data'=>$data]);
	// 	return $pdf->stream('pdf');
    //     return $pdf->download($now.'pdf');
    //     // return view('pdf', ['data'=>$output]);
    //  }
}

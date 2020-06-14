<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

error_reporting(0);
class IndexStikerController extends Controller
{
    //
    
    public function index(Request $request)
    {

        $organisasi = $request->organisasi;
        $ruang = $request->ruang;        
        $masterruang = DB::table('masterruang_view')->get();
        $masterorganisasi = DB::table('masterorganisasi_view')->get();

        if ($request->has(['organisasi', 'ruang'])) 
        {
            $data = DB::table('kib')
            ->join('masterruang', 'masterruang.kodebidang', '=', 'kib.kodebidang')
            ->whereRaw("uraiorganisasi =  '$organisasi' and ruang = '$ruang' and statusdata='aktif' ")
            ->orderBy('kodekib', 'asc')->get();

            $split = '';
            if(count($data) > 0){
                foreach($data as $data){
                    $array[] = $data;
                }
                $countarray = count($array);
                //////// jika jumlah array ganjil maka tambahkan element terakhir dengan nilai pertama dari array :-)
                // if( $countarray % 2 !== 0 ){
                //     array_push($array, $array[0]);
                // }
                $split = array_chunk($array, 9); //split an array 
            }
            // echo '<pre>'.var_dump($split[6]).'</pre>';
            $index = count($split);
            // $bagi = $count / 2;
            // return view('pdf', ['split' => $split, 'index' => $index]);

            $pdf = PDF::loadview( 'pdf', ['split' => $split, 'index' => $index] );
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'margin-bottom' => 0]);
            return $pdf->stream('pdf');
            return $pdf->download(now().'pdf');
        }

        return view('index', ['opd' => $masterorganisasi, 'ruang' => $masterruang, 'org'=>$organisasi, 'rng'=>$ruang] );
    }

    public function test(Type $var = null)
    {
        return view('list');
    }

    public function toPDF(Request $request)
    {
        if( $request->hasAny(['organisasi']) ) {
            // $organisasi = Request::get('organisasi');
            // $data = DB::table('kib')
            // ->join('masterruang', 'masterruang.kodebidang', '=', 'kib.kodebidang')
            // ->whereRaw("uraiorganisasi =  '$organisasi' and ruang = '$ruang' and statusdata='aktif' ")->get();
            
            // // return view('list', ['data' => $data, 'opd' => $masterorganisasi, 'ruang' => $masterruang] );
            // $pdf = PDF::loadview( 'pdf', ['data' => $data] );
            // PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'margin-bottom' => 0]);
            // return $pdf->stream('pdf');
            // return $pdf->download('Hehehe'.'pdf');
            echo 'yes';
        }
        // return view('index', ['data' => $data, 'opd' => $masterorganisasi, 'ruang' => $masterruang] );
    }

    // public function toPDF(Request $request)
    // {
    //     echo 'h';
    // }
}

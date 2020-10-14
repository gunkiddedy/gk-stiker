<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

error_reporting(0);
class IndexStikerController extends Controller
{
    
    public function index(Request $request)
    {

        $masterorganisasi = DB::table('masterorganisasi')->get();

        // $masterruang = DB::table('masterruang')->get();

        if($request->organisasi){

            $org = $request->organisasi;

            $get_organisasi = DB::table('masterorganisasi')->where('organisasi', '=', "$org")->limit(1)->get();

            foreach ($get_organisasi as $value) {
                $kodeurusan = $value->kodeurusan;
                $kodesuburusan = $value->kodesuburusan;
                $kodeorganisasi = $value->kodeorganisasi;
                $kodeunit = $value->kodeunit;
                $kodesubunit = $value->kodesubunit;
            }

            $query_ruang = DB::table('masterruang')
                ->whereRaw("
                    kodeurusan='".$kodeurusan."'
                    AND kodesuburusan='".$kodesuburusan."'
                    AND kodeorganisasi='".$kodeorganisasi."'
                    AND kodeunit='".$kodeunit."'
                    AND kodesubunit='".$kodesubunit."'
                    AND penanggungjawab_jabatan <> ''
                ")->get();

            if ($request->koderuang){
                $data = DB::table('kib')
                ->join('masterruang', 'masterruang.koderuang', '=', 'kib.koderuang')
                ->whereRaw("uraiorganisasi =  '$request->organisasi' and kib.koderuang = '$request->koderuang' and statusdata='aktif' ")
                ->orderBy('kodekib', 'asc')->get();

                $split = '';

                if(count($data) > 0){
                    foreach($data as $data){
                        $array[] = $data;
                    }
                    $split = array_chunk($array, 9);
                }
                
                $index = count($split);

                foreach($data as $k => $v){
                    if($k == 'uraiorganisasi'){
                        $nama_opd = $v;
                    }
                    if($k == 'ruang'){
                        $nama_ruang = $v;
                    }
                    
                }

                $filename = $nama_opd.'-'.$nama_ruang.now();
                $pdf = PDF::loadView( 'pdf', ['split' => $split, 'index' => $index] );
                return $pdf->stream($filename.'pdf');
            }

            return view('index', ['opd' => $get_organisasi, 'ruang' => $query_ruang] );
        }

        // if ($request->has(['koderuang'])) 
        // {
        //     $data = DB::table('kib')
        //     ->join('masterruang', 'masterruang.koderuang', '=', 'kib.koderuang')
        //     ->whereRaw("uraiorganisasi =  '$request->organisasi' and kib.koderuang = '$request->koderuang' and statusdata='aktif' ")
        //     ->orderBy('kodekib', 'asc')->get();

        //     $split = '';

        //     if(count($data) > 0){
        //         foreach($data as $data){
        //             $array[] = $data;
        //         }
        //         $split = array_chunk($array, 9);
        //     }
            
        //     $index = count($split);

        //     foreach($data as $k => $v){
        //         if($k == 'uraiorganisasi'){
        //             $nama_opd = $v;
        //         }
        //         if($k == 'ruang'){
        //             $nama_ruang = $v;
        //         }
                
        //     }

        //     $filename = $nama_opd.'-'.$nama_ruang.now();
        //     $pdf = PDF::loadView( 'pdf', ['split' => $split, 'index' => $index] );
        //     return $pdf->stream($filename.'pdf');
        // }

        return view('index', ['opd' => $masterorganisasi, 'ruang' => $masterruang] );
    }

    public function test(Request $request)
    {

        $organisasi = $request->organisasi;
        $ruang = $request->ruang;
        
        // loop from table masterruang and master organisasi
        $masterruang = DB::table('masterruang_view')->get();
        $masterorganisasi = DB::table('masterorganisasi_view')->get();

        // if get request organisasi and ruang
        if ($request->has(['organisasi', 'ruang'])) 
        {
            $data = DB::table('kib')
            ->join('masterruang', 'masterruang.kodebidang', '=', 'kib.kodebidang')
            ->whereRaw("uraiorganisasi =  '$organisasi' and ruang = '$ruang' and statusdata='aktif' ")
            ->orderBy('kodekib', 'asc')->get();

            $split = '';

            // if data found make a loop for each data
            if(count($data) > 0){
                foreach($data as $data){
                    $array[] = $data;
                }
                // split array become 9 data per index
                $split = array_chunk($array, 9);
            }
            
            // count of array (passing into view and get i for loop)
            $index = count($split);

            // only render to view
            return view('pdf', ['split' => $split, 'index' => $index]);

        }

        // if no request redirect to the index page
        // return view('index', ['opd' => $masterorganisasi, 'ruang' => $masterruang, 'org'=>$organisasi, 'rng'=>$ruang] );
    }

    // public function toPDF(Request $request)
    // {
    //     if( $request->hasAny(['organisasi']) ) {
    //         $organisasi = Request::get('organisasi');
    //         $data = DB::table('kib')
    //         ->join('masterruang', 'masterruang.kodebidang', '=', 'kib.kodebidang')
    //         ->whereRaw("uraiorganisasi =  '$organisasi' and ruang = '$ruang' and statusdata='aktif' ")->get();
            
    //         // return view('list', ['data' => $data, 'opd' => $masterorganisasi, 'ruang' => $masterruang] );
    //         $pdf = PDF::loadview( 'pdf', ['data' => $data] );
    //         PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'margin-bottom' => 0]);
    //         return $pdf->stream('pdf');
    //         return $pdf->download('Hehehe'.'pdf');
    //         echo 'yes';
    //     }
    //     return view('index', ['data' => $data, 'opd' => $masterorganisasi, 'ruang' => $masterruang] );
    // }

}

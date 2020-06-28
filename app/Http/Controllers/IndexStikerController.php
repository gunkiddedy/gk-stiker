<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

error_reporting(0);
class IndexStikerController extends Controller
{
    //
    
    public function index(Request $request)
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
            // return view('pdf', ['split' => $split, 'index' => $index]);

            foreach($data as $k => $v){
                if($k == 'uraiorganisasi'){
                    $nama_opd = $v;
                }
                if($k == 'ruang'){
                    $nama_ruang = $v;
                }
                
            }
            // print_r($nama_opd.' - '.$nama_ruang);
            $filename = $nama_opd.'-'.$nama_ruang.now();
            // generate to pdf file
            // $view = view('pdf', ['split' => $split, 'index' => $index]);
            // PDF::loadHTML($view)->save('ftftft.pdf');
            // PDF::setOptions(['enable-javascript' => true,'javascript-delay' => 13500]);
            $pdf = PDF::loadView( 'pdf', ['split' => $split, 'index' => $index] );
            // PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'margin-bottom' => 0]);
            // return $pdf->stream('pdf');
            return $pdf->stream($filename.'pdf');
        }

        // if no request redirect to the index page
        return view('index', ['opd' => $masterorganisasi, 'ruang' => $masterruang, 'org'=>$organisasi, 'rng'=>$ruang] );
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

<?php

namespace App\Http\Controllers;

use App\Stiker;
use Datatables;
// use Redirect,Response,DB,Config;
use App\StikerCharts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StikerController extends Controller
{
 
    public function index()
    {
        return view('stiker');
    }

    // DATATABLES YAJRA
    public function stikerList(Request $request)
    {   
        // $stikerQuery = Stiker::query();
 
        $nama_opd = (!empty($_GET["nama_opd"])) ? ($_GET["nama_opd"]) : ('');
        $nama_ruang = (!empty($_GET["nama_ruang"])) ? ($_GET["nama_ruang"]) : ('');
        $nama_barang = (!empty($_GET["nama_barang"])) ? ($_GET["nama_barang"]) : ('');
        
        // tanpa pencarian
        // $stikers = Stiker::select('*')->inRandomOrder()->limit(50);
        $stikers = Stiker::skip(10)->take(50)->get();
        
        // dengan pencarian
        if($nama_opd && $nama_ruang && $nama_barang)
            $stikers = Stiker::whereRaw("nama_barang like '%$nama_barang%' and nama_ruang like '%$nama_ruang%' and nama_opd= '$nama_opd' ")->limit(50);

        if ($request->ajax()) {
            return datatables()->of($stikers)
                ->addIndexColumn()
                ->addColumn('action', function($kode_barang){

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kode_barang="'.$kode_barang->kode_barang.'" data-original-title="Edit" class="btn btn-primary btn-sm" id="ambilBarang">Ambil</a>';

                        // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCustomer">Delete</a>';

                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return view('StikerAjax');
        // ->addColumn('action', function ($kode_barang) {
        //     return '<a href="/stiker/getkode/'.$kode_barang->kode_barang.'" class="btn btn-success" data-id='.$kode_barang->kode_barang.' id="btn_ambil">
        //         <i class="glyphicon glyphicon-edit"></i> Ambil</a>';
        // })->editColumn('kode_barang', 'kode_barang: {{$kode_barang}}')->removeColumn('password')->make(true);
    }
    

    public function StoreintoChart(Request $request)
    {
        $jumlah = $request['jumlah'];

        for($i=1; $i<=$jumlah; $i++){
            $request->validate([
                'kode_barang' => 'required',
                'nama_barang' => 'required',
                'nama_ruang' => 'required',
                'kode_lokasi' => 'required',
                'nama_opd' => 'required',
                'qrcode' => 'required',
                'jumlah' => 'required',
            ]);
            StikerCharts::create($request->all());
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan ke antrian cetak!'
        ]);


        // DB::table('users')->insert([
        //     ['email' => 'taylor@example.com', 'votes' => 0],
        //     ['email' => 'dayle@example.com', 'votes' => 0]
        // ]);


        // return json_encode(array(
        //     "statusCode"=>200
        // ));

        // echo 'test chart';
        // StikerCharts::updateOrCreate(
        //     [
        //         'kode_barang' => $request->kode_barang
        //     ],
        //     [
        //         'kode_barang' => $request->kode_barang,
        //         'jumlah' => $request->jumlah
        //     ]
        //     );
    
        //     return response()->json(
        //     [
        //         'success' => true,
        //         'message' => 'Data berhasil ditambahkan ke antrian cetak!'
        //     ]
        // );
    }

    public function getKode($kode_barang)
    {
        $data = Stiker::where('kode_barang',$kode_barang)->get();
        return response()->json($data);
    }
  
    public function destroy($id)
    {
        $stikercharts = StikerCharts::find($id);

        $stikercharts->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }

    // public function Store(Request $request)
    // {
    //     Stikercharts::updateOrCreate(
    //         [
    //             'kode_barang' => $request->kode_barang,
    //             'jumlah' => $request->jumlah
    //         ]
    //     );

    //     return response()->json(
    //         [
    //             'success' => true,
    //             'message' => 'Data inserted successfully'
    //         ]
    //     );
    // }


    


    // public function index()
    // {
    //     // if( !empty($request->input('nama_opd')) && !empty($request->input('nama_ruang')) ){
    //     //     $stikers = Stiker::where('nama_opd', 'like', '%'.$request->input('nama_opd').'%')
    //     //     ->orWhere('nama_ruang', 'like', '%'.$request->input('nama_ruang').'%')
    //     //     ->limit(5)->get();
    //     // }

    //     $stikers = '';
    
    //     return view('stiker', ['stikers' => $stikers] );
    // }
    
    // public function searchData(Request $request)
    // {
    //     if( !empty($request->input('nama_opd')) && !empty($request->input('nama_ruang')) ){
    //         $stikers = Stiker::where('nama_opd', 'like', '%'.$request->input('nama_opd').'%')
    //         ->orWhere('nama_ruang', 'like', '%'.$request->input('nama_ruang').'%')
    //         ->limit(5)->get();
    //     }    
    //     return view('stiker', ['stikers' => $stikers]);
    // }
}

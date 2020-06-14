@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">Daftar Cetak</div>

                <div class="card-body">
                    <div class="alert alert-info">
                        {{-- @if (!empty($charts)) --}}
                        <a class="btn btn-danger" href="{{route('print')}}" id="printBtn">Print Stiker</a>
                        {{-- @else --}}
                        <a class="btn btn-success" href="{{route('truncate')}}" id="truncateBtn">Kosongkan Chart</a>                         
                        {{-- @endif --}}
                    </div>
                    <br>
                    <table class="table table-hover" id="laravel_datatable" style="overflow: scroll">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Ruang</th>
                                <th>Kode Lokasi</th>
                                <th>Nama OPD</th>
                                <th>QRCode</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                        @endif
                        
                        <tbody>
                            @foreach ($charts as $chart)
                            <tr>
                                <td>{{ $chart->kode_barang }}</td>
                                <td>{{ $chart->nama_barang }}</td>
                                <td>{{ $chart->nama_ruang }}</td>
                                <td>{{ $chart->kode_lokasi }}</td>
                                <td>{{ $chart->nama_opd }}</td>
                                <td>{!! QrCode::color(255, 155, 20)->size(50)->generate($chart->qrcode); !!}</td>
                                <td>{{ $chart->jumlah }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="font-weight: bold">Total</td>
                                <td colspan="" style="font-weight: bold">{{ $total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-info">
                        <form method="GET">
                            <div class="form-group">
                                <label for="organisasi">Nama OPD</label>
                                <select name="organisasi" id="nama_opd" class="form-control">
                                    @foreach ($opd as $item)
                                        <option value="{{ $item->organisasi }}">{{ $item->organisasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ruang"> Nama Ruang</label>
                                <select name="ruang" id="nama_ruang" class="form-control">
                                    @foreach ($ruang as $item)
                                        <option value="{{ $item->ruang }}">{{ $item->ruang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="btnFiterSubmitSearch" class="btn btn-success">
                                    <i class="fa fa-search"></i> Download PDF
                                </button>
                                {{-- <input type="reset" id="reset" value="Reload page" class="btn btn-success"> --}}
                            </div>
                        </form>
                    </div>
                    <br>
                    {{-- <table class="table table-hover" id="liststiker" style="overflow: scroll">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kode Lokasi</th>
                                <th>Nama Ruang</th>
                                <th>Nama OPD</th>
                                <th>QrCode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($data))
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->kodekib }}</td>
                                        <td>{{ $item->deskripsibarang }}</td>
                                        <td>{{ $item->nolokasi }}</td>
                                        <td>{{ $item->ruang }}</td>
                                        <td>{{ $item->uraiorganisasi }}</td>
                                        <td>{{ $item->qrcode }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6"><a class="btn btn-danger" href={{ route('topdf') }} id="printBtn">Print Stiker</a></td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $data }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    $(document).ready( function () {
        $("select").select2();
    });
</script>
@endpush
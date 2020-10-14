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
                        <form method="GET" id="form1">
                            <div class="form-group">
                                <label for="organisasi">Nama OPD</label>
                                <select name="organisasi" id="organisasi" class="form-control">
                                    <option value="">
                                        {{ ($_GET['organisasi']) ? '-Tampilkan semua-' : '-Pilih-'}}
                                    </option>
\                                   @foreach ($opd as $item)
                                        <option value="{{ $item->organisasi }}"
                                            {{ ($item->organisasi == $_GET['organisasi']) ? 'selected' : '' }} >
                                            {{ $item->organisasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ruang"> Nama Ruang</label>
                                <select name="koderuang" id="koderuang" class="form-control">
                                    <option value="">-Pilih-</option>
                                    @foreach ($ruang as $item)
                                        <option value="{{ $item->koderuang }}">{{ $item->ruang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group">
                                
                                <button type="submit" id="btnFiterSubmitSearch" class="btn btn-success">
                                    {{ ($_GET['organisasi']) ? 'Download PDF' : 'Cari data'}}
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

        $('#organisasi').on('change', function(e){
            $('#form1').submit();
        });
    });
</script>
@endpush
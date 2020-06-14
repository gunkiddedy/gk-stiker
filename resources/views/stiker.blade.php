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
                        <form id="formstiker">
                            <div class="form-inline">
                                {{-- <label for="exampleFormControlFile1">Nama Barang</label> --}}
                                <input type="text" style="width: 40%" required='required' name="nama_barang" id="nama_barang" class="form-control " placeholder="Nama Barang">-
                                <input type="text" style="width: 40%" required='required' name="nama_ruang" id="nama_ruang" class="form-control" placeholder="Nama ruang"> 
                            </div>
                            <div class="form-group">
                                {{-- <label for="exampleFormControlFile1">Nama Ruang</label> --}}
                            </div>
                            <div class="form-group">
                                {{-- <label for="exampleFormControlFile1">Nama OPD</label> --}}
                                <input type="text" style="width: 80.5%" required='required' name="nama_opd" id="nama_opd" class="form-control" placeholder="Nama OPD"> 
                            </div>
                            <div class="form-group">
                                    <button type="submit" id="btnFiterSubmitSearch" class="btn btn-info">
                                        <i class="fa fa-search"></i> Filter barang
                                    </button>
                                    <input type="reset" id="reset" value="Reload page" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                
                    {{-- <div class="loader" style="display:none"> --}}
                        <img src="{{ asset('loader.gif') }}" alt="" style="display: none">
                    {{-- </div> --}}
                    <table class="table table-hover" id="laravel_datatable" style="overflow: scroll">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kode Lokasi</th>
                                <th>Nama Ruang</th>
                                <th>Nama OPD</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                    @include('modal')
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    $(document).ready( function () {        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#laravel_datatable').DataTable({
            processing: true,
            "language": {
                processing: '<p><img src="{{ asset('loader-fading-squares-transparent.gif') }}" alt="" style="display: block; margin:0 auto;"></p>',
            },
            serverSide: true,
            ajax: {
                url: '{{route("stiker.list") }}',
                // type: 'GET',
                data: function (d) {
                    d.nama_barang = $('#nama_barang').val();
                    d.nama_ruang = $('#nama_ruang').val();
                    d.nama_opd = $('#nama_opd').val();
                }
            },
            columns: [
                { data: 'kode_barang', name: 'kode_barang' },
                { data: 'nama_barang', name: 'nama_barang' },
                { data: 'kode_lokasi', name: 'kode_lokasi' },
                { data: 'nama_ruang', name: 'nama_ruang' },
                { data: 'nama_opd', name: 'nama_opd' },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });

    $('#formstiker').on('submit', function(e){
        $('#laravel_datatable').DataTable().draw(true);
        e.preventDefault();
    });
    $('#reset').click(function() {
        window.location = '{{ route('stiker.index') }}';
        // $('#laravel_datatable').DataTable().draw(true);
    });

    // modal
    $('body').on('click', '#ambilBarang', function () {
        var kb = $(this).data('kode_barang');
        // alert(id);
        $.get('/stiker/getkode/' + kb, function (data) {
            // $('#modelHeading').html("Edit Customer");
            // $('#saveBtn').val("edit-user");
            $('#modal_stiker').modal('show');
            // $('#Customer_id').val(data.id);
            $('#kode_barangnya').html(data[0].kode_barang);
            $('.kode_barangnya').val(data[0].kode_barang);
            $('.nama_barangnya').val(data[0].nama_barang);
            $('.nama_ruangnya').val(data[0].nama_ruang);
            $('.kode_lokasinya').val(data[0].kode_lokasi);
            $('.nama_opdnya').val(data[0].nama_opd);
            $('.qrcodenya').val(data[0].qrcode);
            $('#nama_barangnya').html('Nama Barang : '+data[0].nama_barang);
            $('#kode_lokasinya').html('Kode Lokasi : '+data[0].kode_lokasi);
            $('#nama_ruangnya').html('Nama Ruang : '+data[0].nama_ruang);
            $('#nama_opdnya').html('Nama OPD : '+data[0].nama_opd);
            // $('#detail').val(data.detail);
            console.log(data);
        })
    });

    // save to stikercharts table
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#form_stiker').serialize(),
            type: "POST",
            dataType: 'json',
            url: '/stiker/store',
            success: function (data) {
                if (data.success === true) {
                    Swal.fire("Success!", data.message, "success");
                } else {
                    Swal.fire("Error!", data.message, "error");
                }
                $('#form_stiker').trigger("reset");
                $('#modal_stiker').modal('hide');
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });

    
</script>
@endpush

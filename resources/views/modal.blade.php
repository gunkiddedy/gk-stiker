<div class="modal fade" id="modal_stiker">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" > Kode Barang <b><i id="kode_barangnya"></i></b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <ul class="list-group">
                    <b><li class="list-group-item" id="nama_barangnya"></li>
                    <li class="list-group-item" id="kode_lokasinya"></li>
                    <li class="list-group-item" id="nama_ruangnya"></li>
                    <li class="list-group-item" id="nama_opdnya"></li></b>
                </ul>
                <br>
                <form id="form_stiker" name="form_stiker" class="form-horizontal" >
                    <input type="hidden" name="kode_barang" class="kode_barangnya">
                    <input type="hidden" name="nama_barang" class="nama_barangnya">
                    <input type="hidden" name="nama_ruang" class="nama_ruangnya">
                    <input type="hidden" name="nama_opd" class="nama_opdnya">
                    <input type="hidden" name="kode_lokasi" class="kode_lokasinya">
                    <input type="hidden" name="qrcode" class="qrcodenya">
                    <input type="number" 
                        id="jumlah" name="jumlah" 
                        value="" class="form-control" 
                        placeholder="Masukkan jumlah stiker yg akan dicetak">
                    <br>
                    <input type="submit" value="Submit" id="saveBtn" class="btn btn-outline-danger" style="float: right">

                </form>
            </div>

        </div>
    </div>
</div>
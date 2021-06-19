<style>
.hidden-required{
    opacity:0;
    width:0;
}
#item_table .select2-container--default{
    width: 100% !important;
}
.select2-container--default .select2-selection--single {
    background-color: #f9f9f9;
    border: 1px solid #c4c0c0;
}
.select2-selection--single:focus{
    background: #ffffff !important;
}

/* :focus */
</style>
<div id="form-peminjamanproses">
    <form method="post" data-toogle="validator" class="form-horzontal" id="form">
        @method('POST')
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">Nama Peminjam</label>
                    <input type="text" class="form-control" name="nama" id="nama" required autofocus>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">NIP</label>
                    <input type="text" class="form-control" name="nip" id="nip" readonly>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Unit Kerja</label>
                    <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" readonly>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Kegiatan</label>
                    <select id="kegiatan" class="form-control" required="true" name="kegiatan">
                        <option value="">-- Pilih kegiatan --</option>
                        @foreach ($kegiatan as $val)
                            <option data-id="{{ $val->batas_waktu }}" value="{{ $val->id }}">{{ $val->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal Pinjam</label>
                    <div class='input-group'>
                        <input type='text' id="tanggalPinjam" name="tanggal_pinjam" class="form-control date" required readonly/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal Jatuh Tempo</label>
                    <div class='input-group'>
                        <input type='text' id="tanggalKembali" name="tanggal_kembali" class="form-control date" required readonly/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label for="name" class="control-label">Peminjaman Via</label>
                    <input type="text" name="via" class="form-control" id="via" required="true">
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>


        {{-- tidide --}}
        <div class="panel-body table-responsive">
            <table class="table table-striped table-borderless" style="width:100%" id="item_table">
                <thead>
                    <tr>
                        <th width="10%">No Warkah</th>
                        <th width="8%">Jenis Warkah <input type="checkbox" id="samakan-jenis"></th>
                        <th width="8%">Album</th>
                        <th width="20%">Posisi Warkah</th>
                        <th width="13%">Desa, Kecamatan <input type="checkbox" id="samakan-desa"></th>
                        <th width="5%" class="text-right">
                            <button type="button" name="add" class="btn btn-success add btn-sm pull-right"><i class="fa fa-plus text-white"></i></button>
                            <input type="text" required class="hidden-required">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row1">
                        <td><input type="text" name="newno_warkah[]" id="no_warkah1" class="form-control autocompleteWarkah no_warkah" datarow="1" placeholder="Nomor Warkah" required/></td>
                        <td><input type="text" name="newjenis[]" id="jenis1" class="form-control jenis" placeholder="Jenis Warkah" /></td>
                        <td><input type="text" name="newalbum[]" id="album1" class="form-control" placeholder="Album" /></td>
                        <td><input type="text" name="newposisi[]" id="posisi1" class="form-control" placeholder="Posisi" /></td>
                        <td><select class="form-control desa" name="newdesa[]"  id="desa1"></select></td>
                        <td width="5%" class="text-right"><button type="button" name="remove" class= "btn btn-danger remove btn-sm"><i class="fa fa-minus"></i></button></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
            <button type="button" class="btn btn-default pull-right" onclick="btnCancel()" style="margin-right: 10px;"><i class="fa fa-times-circle"></i> Batal</button>
        </div>
        {{-- tidide --}}

    </form>
</div>

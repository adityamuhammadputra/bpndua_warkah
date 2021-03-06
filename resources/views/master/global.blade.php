   <style>
    .form-group{
         height: 30px;
    }
    .select2-container--default{
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single {
        background-color: #f9f9f9;
        border: 1px solid #c4c0c0;
    }
    .select2-selection--single:focus{
        background: #ffffff !important;
    }
   </style>
    <div class="modal" id="modal_large" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                     <h4 class="modal-title" id="largeModalHead">Tambah</h4>
                </div>
                <form method="post" class="form-horzontal form-user">
                     @method('POST')
                     @csrf
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="type" name="type">
                    <div class="modal-body">
                        <div class="form-group kegiatan">
                             <label class="col-sm-4 control-label" for="nama_kegiatan">Nama Kegiatan</label>
                             <div class="col-sm-8">
                                 <input type="text" placeholder="Nama Kegiatan" id="nama_kegiatan" name="nama_kegiatan" class="form-control" required>
                             </div>
                         </div>
                         <div class="form-group kegiatan">
                             <label class="col-sm-4 control-label" for="batas_waktu">Batas Waktu</label>
                             <div class="col-sm-8">
                                 <input type="number" placeholder="Batas Waktu" id="batas_waktu" name="batas_waktu" class="form-control" required>
                             </div>
                         </div>
                         <div class="form-group peminjam">
                             <label class="col-sm-4 control-label" for="nip">NIP</label>
                             <div class="col-sm-8">
                                 <input type="text" placeholder="NIP" id="nip" name="nip" class="form-control" required>
                             </div>
                         </div>
                         <div class="form-group peminjam">
                             <label class="col-sm-4 control-label" for="nama">Nama</label>
                             <div class="col-sm-8">
                                 <input type="text" placeholder="Nama" id="nama" name="nama" class="form-control" required>
                             </div>
                         </div>
                         <div class="form-group peminjam">
                            <label class="col-sm-4 control-label" for="unit_kerja">Unit Kerja</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Unit Kerja" id="unit_kerja" name="unit_kerja" class="form-control" required>
                            </div>
                        </div>
                        @if ($kegiatan ?? '')
                        <div class="form-group peminjam">
                            <label class="col-sm-4 control-label" for="kegiatan_id">Kegiatan</label>
                            <div class="col-sm-8">
                                <select name="kegiatan_id"  id="kegiatan_id" class="form-control select2">
                                    <option value="">-- Pilih kegiatan --</option>
                                    @foreach ($kegiatan as $kegiatan)
                                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama_kegiatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="warkah">

                            <div class="form-group single" style="display: none;">
                                <label class="col-sm-4 control-label" for="nama_kegiatan">Nomor Warkah</label>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Nomor Warkah" id="no_warkah" name="no_warkah" class="form-control">
                                </div>
                                @if (isset($data))
                                <div class="col-sm-2">
                                    <select name="tahun"  id="tahun" class="form-control select2">
                                        @foreach ($data->tahun as $val)
                                            <option value="{{ $val->name }}" {{ date('Y') == $val->name ? 'selected' : '' }}>
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="nama_kegiatan">Album</label>
                                <div class="col-sm-8">
                                    <input type="text" name="album"  id="album" class="form-control" required>
                                </div>
                            </div>
                            @if (isset($data))
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="kegiatan_id">jenis</label>
                                <div class="col-sm-8">
                                    <select name="jenis"  id="jenis" class="form-control select2" required>
                                        <option value="" disabled>-- Pilih Jenis --</option>
                                        @foreach ($data->jenis as $valJenis)
                                            <option value="{{ $valJenis->id }}">{{ $valJenis->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="nama_kegiatan">Posisi</label>
                                <div class="col-sm-8">
                                    <select name="ruang"  id="ruang" class="form-control select2" required>
                                        <option value="">-- Pilih Ruang --</option>
                                        @foreach ($data->ruang as $valRuang)
                                            <option value="{{ $valRuang->name }}">{{ $valRuang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4 col-sm-offset-4">
                                    <select name="rak"  id="rak" class="form-control select2" required>
                                        <option value="">-- Rak --</option>
                                        @foreach (range('A', 'Z') as $val)
                                            <option value="{{ $val}}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select name="baris"  id="baris" class="form-control select2" required>
                                        <option value="">-- Baris --</option>
                                        @foreach (range(1, 25) as $val)
                                            <option value="{{ $val}}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 47px;">
                                <label class="col-sm-4 control-label" for="nama_kegiatan">Desa / Kecamata</label>
                                <div class="col-sm-8">
                                    <select name="desa"  id="desa" class="form-control select2" required>
                                        @foreach ($data->desa as $valDesa)
                                            <option value="{{ $valDesa->name }}, {{ $valDesa->kecamatan }}">{{ $valDesa->name }}, {{ $valDesa->kecamatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group multiple">
                                <label class="col-sm-4 control-label" for="nama_kegiatan">Nomor Warkah</label>
                                <div class="col-sm-5">
                                    <input type="text" placeholder="Nomor Warkah" id="no_warkah_multi" name="no_warkah_multi[]" class="form-control">
                                </div>

                                @if (isset($data))
                                <div class="col-sm-2">
                                    <select name="tahun"  id="tahun" class="form-control select2">
                                        @foreach ($data->tahun as $val)
                                            <option value="{{ $val->name }}" {{ date('Y') == $val->name ? 'selected' : '' }}>
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-sm bnt-primary newRow" style="padding-right: 0px;">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="multiples">

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-default btn-kirim">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal" id="modal_upload" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="largeModalHead">Upload Warkah Excel</h4>
                </div>
                <form method="post" class="form-horzontal form-upload" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="modal-body">


                        @if (isset($data))
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="unit_kerja">Jenis Warkah</label>
                            <div class="col-sm-8">
                                <select name="jenis" id="jenis" class="form-control">
                                    @foreach ($data->jenis as $jen)
                                        <option value="{{ $jen->id }}">{{ $jen->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="unit_kerja">Simpan untuk Kantor</label>
                            <div class="col-sm-8">
                                <select name="kantor_id" id="kantor_id" class="form-control">
                                    @foreach ($data->kantor as $k)
                                        <option value="{{ $k->id }}" {{ (userKantorId() == $k->id) ? 'selected' : '' }}>{{ $k->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="unit_kerja">Ruang</label>
                            <div class="col-sm-8">
                                <select name="ruang" id="ruang" class="form-control">
                                    @foreach ($data->ruang as $r)
                                        <option value="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="col-sm-4 control-label" for="nip">File Excel</label>
                            <div class="col-sm-8">
                                <input type="file" id="files" name="files" class="form-control" required>
                                <a class="pull-right" href="/upload/contoh.xlsx" target="_blank">Lihat template file</a>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-default btn-kirim-upload">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@push('scripts')

    <script>

        $(document).on('click', '.btn-upload-excel', function(){
            $('#modal_upload').modal('show');
        })

        $(document).on('click', '.newRow', function(){
            var html = '<div class="form-group">\
                            <label class="col-sm-4 control-label" for="nama_kegiatan"></label>\
                            <div class="col-sm-7">\
                                <input type="text" placeholder="Nomor Warkah" id="no_warkah_multi" name="no_warkah_multi[]" class="form-control" required>\
                            </div>\
                            <div class="col-sm-1">\
                                <button type="button" class="btn btn-sm bnt-primary removeRow" style="padding-right: 0px;">\
                                    <i class="fa fa-minus"></i>\
                                </button>\
                            </div>\
                        </div>';
            $('.multiples').append(html);
        })
        $(document).on('click', '.removeRow', function(){
            $(this).closest('.form-group').remove();
        })

        $(document).ready(function () {
            $('.select2').select2();
            var segment = '{{ Request::segment(2) }}';
            var uploadButton = '';
            if(segment == 'warkah') {
                uploadButton = '<button class="btn btn-sm btn-mini btn-primary btn-upload-excel" style="margin-right: 10px;"><i class="fa fa-upload"></i> Upload Excel</button>';
            }

            $('.panel-controls').html(uploadButton + '<button class="btn btn-sm btn-mini btn-info" id="tambah-data" data-type="{{ Request::segment(2) }}"><i class="fa fa-plus-circle"></i> Tambah</button>');

            $('#tambah-data').on('click', function () {
                var type = $(this).data('type');
                $('input[name=_method]').val('POST');
                $('#id').val('');
                if(type == 'kegiatan'){
                    $('.modal-title').html('Tambah Kegiatan');
                    $('.peminjam').remove();
                    $('.warkah').remove();
                } else if(type == 'warkah'){
                    $('.modal-title').html('Tambah Warkah');
                    $('.peminjam').remove();
                    $('.kegiatan').remove();
                    $('.single').hide();
                    $('.multiple, .multiples').show();
                } else {
                    $('.modal-title').html('Tambah Peminjam ' + "{{ userKantorName() }}");
                    $('.kegiatan').remove();
                    $('.warkah').remove();
                }
                $('#type').val(type)
                $('.form-user')[0].reset()
                $('.btn-kirim').attr('disabled', false)
                $('#modal_large').modal('show');
            })
        })



        let cekWarkah = (url) => {
            submitData(url)
            $('.btn-kirim').attr('disabled', false)
            return false;
            //disable sama
            $.ajax({
                url: '/api/check-warkah',
                type:'GET',
                data:{
                    'no_warkah' : $('#no_warkah').val(),
                    'tahun' : $('#tahun').val(),
                    'id' : $('#id').val(),
                },
                success: function (data) {
                    if(data > 0) {
                        $('.btn-kirim').attr('disabled', true)
                        $('.globalalertnotif').text('')
                        $('.globalalerthead').text('Nomor Wakah sudah ada, silahkan input data lain. ');
                        $('.globalalertjudul').text('Nomor Warkah' + $('#no_warkah').val() + '/' + $('#tahun').val());
                        $('#globalalert #ya, #submitpeminjamanvalidasi').hide();
                        $('#globalalert').show();
                    } else {
                        submitData(url)
                        $('.btn-kirim').attr('disabled', false)
                    }
                },
                error: function () {
                    alert('terjadi kesahalan, silahkan relaod')
                    window.reload();
                }
            })
        }

        $('#tahun').on('change', function(){
            $('.btn-kirim').attr('disabled', false)
        })

        $('#no_warkah').on('keyup', function(){
            $('.btn-kirim').attr('disabled', false)
        })

        let submitData = (url) => {
            $.ajax({
                url: url,
                type: 'POST',
                data: $('.form-user').serialize(),
                beforeSend: function(){
                    $('.btn-kirim').html('loading...')
                    $('.btn-kirim').attr('disabled', true)
                },
                success: function (data) {
                    toastr["success"](data);
                    $('#data').dataTable().api().ajax.reload()
                    $('.form-user')[0].reset()
                    $('.btn-kirim').html('kirim')
                    $('#modal_large').modal('hide');
                }
            })
            return false;
        }

        let submitUpload = () => {
            $.ajax({
                url: "/master/warkah/upload-excel",
                type: 'POST',
                data: new FormData($(".form-upload")[0]),
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('.btn-kirim-upload').html('loading...')
                    $('.btn-kirim-upload').attr('disabled', true)
                },
                success: function (data) {
                    toastr["success"](data);
                    $('.form-upload')[0].reset()
                    $('.btn-kirim-upload').html('kirim')
                    $('.btn-kirim-upload').attr('disabled', false)
                    $('#modal_upload').modal('hide');
                    $('#data').dataTable().api().ajax.reload()
                },
                error: function () {
                    alert('Terjadi kesalahan, silahkan muat ulang halaman');
                    // window.location.reload();
                }
            })
            return false;
        }
        //simpan

        $('.form-upload').on('submit', function (e) {
            e.preventDefault();
            submitUpload();
        })

        $('.form-user').on('submit', function (e) {
            e.preventDefault();
            var url, id = $('#id').val();
            if(id == '')
                url = "{{ url('master') }}";
            else
                url = "{{ url('master') }}/" + id;

            if($('#type').val() == 'warkah')
                cekWarkah(url);
            else {
                submitData(url)
            }
        })

        // editdata
        $(document).on('click','#editData', function () {
            var id = $(this).data('id');
            var type = $(this).data('type')
            $('input[name=_method]').val('PATCH');
            $('.form-user')[0].reset();
            $('.btn-kirim').attr('disabled', false)
            $.ajax({
                url: "{{ url('master')}}/" + id + "/edit/"+type,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#id').val(data.id);
                    $('#type').val(type);
                    if(type == 'kegiatan'){
                        $('#nama_kegiatan').val(data.nama_kegiatan)
                        $('#batas_waktu').val(data.batas_waktu)
                        $('.modal-title').html('Edit Kegiatan ' + data.nama_kegiatan);
                        $('.peminjam').remove();
                        $('.warkah').remove();
                    } else if(type == 'warkah'){
                        $('.modal-title').html('Edit Warkah ' + data.no_warkah_tahun);
                        $('.single').show();
                        $('.multiple, .multiples').hide();
                        $.each(data,function(index,obj){
                            delete data.created_at
                            delete data.updated_at
                            delete data.no_warkah_tahun
                            delete data.posisi
                            delete data.kantor_id
                            delete data.kantor
                            delete data.file_name
                            $(eval(index)).val(obj)
                            $(eval(index)).val(obj).trigger('change')
                        });
                        $('.peminjam').remove();
                        $('.kegiatan').remove();
                    } else {
                        $('#nip').val(data.nip)
                        $('#nama').val(data.nama)
                        $('#unit_kerja').val(data.unit_kerja)
                        $('#kegiatan_id').val(data.kegiatan_id).trigger('change');
                        $('.modal-title').html('Edit Peminjam ' + "{{ userKantorName() }}");
                        $('.kegiatan').remove();
                        $('.warkah').remove();
                    }
                    $('#modal_large').modal('show');
                },
                error: function () {
                    alert('Terjadi kesalahan, Silahakn reload');
                }

            });
        })

        $(document).on('click','#deleteData', function(){
            var id  = $(this).data('id');
            var type = $(this).data('type');
            var datanama = $(this).data('nama')
            $('#iddata').val($(this).data('id'));
            $('.globalalertnotif').text('hapus')
            $('.globalalerthead').text('Apakah anda yakin akan menghapus data ?');
            $('.globalalertjudul').text(type + ' '+ datanama);
             urlnotif = "{{ url('master')}}/" + id + '/' +type;
            $('.alert-form input[name=_method]').val('DELETE');
            $('#globalalert').removeClass('message-box-info').addClass('message-box-danger');

            $('.alert-form').find('.btn-primary').prop('disabled', false);
            $('.alert-form').find('.btn-primary').html('Ya!');
            $('#globalalert').show();

        });

        $('.alert-form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: urlnotif,
                type: "POST",
                data: $('.alert-form').serialize(),
                beforeSend: function() {
                    $('.alert-form').find('.btn-primary').prop('disabled', true);
                    $('.alert-form').find('.btn-primary').html('Loading...');
                },
                success: function (data) {
                    $('#data').dataTable().api().ajax.reload()
                    toastr["success"](data);
                    $('.alert-form')[0].reset();
                    $('#globalalert').hide();
                },
                error: function () {
                    alert('Terkadi Kesalahan, Silahkan Reload');
                }
            });
            return false;
        });

    </script>
@endpush

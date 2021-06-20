@push('scripts')
<script type="text/javascript">
    var typenotif,urlnotif, message, reload, remove;
    var dateNow = new Date();
    $(document).on('click', '.alertshow', function(){
        type = $(this).data('type');
        $('#iddata').val($(this).data('id'));
        var id = $('#iddata').val();
        var typenotif = $(this).data('type');
        $('.globalalertnotif').text($(this).data('type'))
        $('.globalalerthead').text('Apakah anda yakin akan '+$(this).data('head')+' data ?');
        $('.globalalertjudul').text($(this).data('judul'));
        if(typenotif == 'Hapus'){
            urlnotif = "{{ url('peminjaman/register') . '/'}}" + id;
            $('.alert-form input[name=_method]').val('DELETE');
            $('#globalalert').removeClass('message-box-info').addClass('message-box-danger');
        }else if(typenotif == 'Validasi'){
            urlnotif = "{{ url('peminjaman/registervalidasi') . '/'}}" + id;
            $('.alert-form input[name=_method]').val('PATCH');
            $('#globalalert').removeClass('message-box-danger').addClass('message-box-success');
        }else{
            $('.alert-form input[name=_method]').val('PATCH');
            urlnotif = "{{ url('peminjaman/registercetak') . '/'}}" + id;
            $('#globalalert').removeClass('message-box-danger').addClass('message-box-success');
        }
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
                $('#data-peminjaman').dataTable().api().ajax.reload()
                toastr["success"](data.message);
                $(data.id).closest("tr").remove()
                if(data.cetak=='cetak'){
                    window.open(data.link);
                    window.focus();
                }
                $('.alert-form')[0].reset();
                $('#globalalert').hide();
            },
            error: function () {
                alert('Terkadi Kesalahan, Silahkan Reload');
            }
        });
        return false;
    });

    $('#samakan-jenis').on('click',function () {
        var jenis_hak = $('#item_table tr input.jenis:first').val();
        if($(this).prop('checked')){
            $('.jenis').val(jenis_hak);
        }
        else{
            $('.jenis').val('');
        }
    })

    $('#samakan-desa').on('click',function () {
        var desa = $('#item_table tr select.desa:first').val();
        if($(this).prop('checked')){
            $(".desa").val(desa).trigger('change')
        }
        else{
            $('.desa').val('').trigger('change');
        }
    })


    // tidei
    $(document).ready(function(){
        $(document).on('click', '.add', function(){
            var i = $('#item_table tbody tr').length;
            i++;
            var html = '<tr class="row'+i+'">\
                            <td>\
                                <input type="text" name="newno_warkah[]" id="no_warkah'+i+'" class="form-control autocompleteWarkah no_warkah" datarow="'+i+'" placeholder="Nomor Warkah" required/>\
                                <input type="hidden" name="newwarkah_id[]" id="warkah_id'+i+'">\
                            </td>\
                            <td><input type="text" name="newjenis[]" id="jenis'+i+'" class="form-control jenis" placeholder="Jenis Warkah" readonly/></td>\
                            <td><input type="text" name="newalbum[]" id="album'+i+'" class="form-control" placeholder="Album" readonly/></td>\
                            <td><input type="text" name="newposisi[]" id="posisi'+i+'" class="form-control" placeholder="Posisi" readonly/></td>\
                            <td><select class="form-control desa" name="newdesa[]"  id="desa'+i+'""></select></td>\
                            <td width="5%" class="text-right"><button type="button" name="remove" class= "btn btn-danger remove btn-sm"><i class="fa fa-minus"></i></button></td>\
                        </tr>';
            $('#item_table').append(html);
            desa(i, val='')
            autoCompleteWarkah()
            $(".no_warkah").focus();
            // $('.hidden-required').removeAttr('required');
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
            i--;
        });
    });
    // tidei
    autoCompleteWarkah()

    function desa(i, val){
        $.ajax({
            type:"GET",
            url:"{{url('api/desa')}}",
            success:function(res){
                if(res){
                    $("#desa"+i).select2();
                    $("#desa"+i).empty();
                    $("#desa"+i).append('<option value="" disabled selected>Desa, Kecamatan</option>');
                    $.each(res,function(key,value) {
                        $("#desa"+i).append('<option value="'+value.name+', '+value.kecamatan+'">'+value.name+', '+value.kecamatan+'</option>');
                    });
                    $('#desa'+i).val(val).trigger('change');
                }else{
                    $("#desa"+i).empty();
                }
            }
        });
    }


    // autocomplete
    $(document).ready(function() {
        src = "{{ url('autocompletepegawai') }}";
        $("#nama").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: src,
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select:function(event, ui){
                var nip =ui.item.id;
                $.ajax({
                    type: "GET",
                    url: "{{ url('autocompletepegawaishow')}}",
                    data : {
                        nip : nip
                    },
                    cache: false,
                    dataType: "html",
                    beforeSend  : function(){
                        $(".prosesloading").show();
                    },
                    success: function(data){
                        var datashow = JSON.parse(data);
                        $("#nama").val(datashow[0].nama);
                        $("#nip").val(datashow[0].nip);
                        $("#unit_kerja").val(datashow[0].unit_kerja);
                        $('#kegiatan').val(datashow[0].kegiatan_id);
                        $('#kegiatan').trigger('change');
                        $('#via').focus();
                    }
                });
            },
            minLength: 2,
        });


    });

    // $(document).('.autocompleteWarkah', '')
    function autoCompleteWarkah () {
        $(".autocompleteWarkah").autocomplete({
            source: function(request, response) {
                var that = $(this);
                $.ajax({
                    url: '/api/autocomplete-warkah',
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select:function(event, ui){
                var idRow = event.target.attributes.datarow.value;
                if(!ui.item.id) {
                    $('#no_warkah' + idRow).val('');
                    $('#jenis' + idRow).val('');
                    $('#album' + idRow).val('');
                    $('#posisi' + idRow).val('');
                    $('#warkah_id' + idRow).val('');
                    $('#desa' + idRow).val('');
                    return false;
                }

                var idWarkah = ui.item.id;
                $.ajax({
                    type: "GET",
                    url: "{{ url('/api/show-autocomplete-warkah')}}",
                    data : {
                        id : idWarkah,
                        row : idRow,
                    },
                    cache: false,
                    dataType: "html",
                    beforeSend  : function(){
                        $(".prosesloading").show();
                    },
                    success: function(data){
                        var dataWarkah = JSON.parse(data);
                        var i = dataWarkah.row;
                        $('#no_warkah' + i).val(dataWarkah.no_warkah);
                        $('#jenis' + i).val(dataWarkah.jenis);
                        $('#album' + i).val(dataWarkah.album);
                        $('#posisi' + i).val(dataWarkah.posisi);
                        $('#warkah_id' + i).val(dataWarkah.warkah_id);
                        desa(i, dataWarkah.desa)
                        return false;
                        // $("#nama").val(datashow[0].nama);
                        // $("#nip").val(datashow[0].nip);
                        // $("#unit_kerja").val(datashow[0].unit_kerja);
                        // $('#kegiatan').val(datashow[0].kegiatan_id);
                        // $('#kegiatan').trigger('change');
                    }
                });
            },
            minLength: 2,
        });
    }


    function setDate() {
        var dateNext = new Date();
        dateNext.setDate(dateNext.getDate() + 14);
        $('#tanggalPinjam').datetimepicker({
            defaultDate:dateNow,
            format:'DD/MM/YYYY HH:mm'
        });
        $('#tanggalKembali').datetimepicker({
            defaultDate:dateNext,
            format:'DD/MM/YYYY HH:mm'
        });
    }
    $(document).ready(function() {
        setDate();
    });

    $(document.body).on("change","#kegiatan",function(){
        var time = $(this).find(':selected').data('id');
        var dateNow = new Date();
        var dateNext = new Date();
        dateNow.setDate(dateNow.getDate());
        dateNext.setDate(dateNext.getDate() + time);
        $('#tanggalKembali').data("DateTimePicker").date(dateNext);
        $('#tanggalPinjam').data("DateTimePicker").date(dateNow);
    });

    $(document).on("change",".desa",function(){
        // var val = $(this).find(':selected').data('kecamatan')
        var newi = $(this).data('i');
        // $('#kecamatan'+newi).val(val);
    })

    $(document).on("change",".desaedit",function(){
        // var val = $(this).find(':selected').data('kecamatan')
        // var newi = $(this).data('i');
        // $('#kecamatan'+newi).val(val);
    })
    //

    $(document).ready(function() {
        $('#kegiatan').select2();
    });

    function btnCancel(){
        $('#id').val('');
        $('.tombol-simpan').text('Simpan');
        $('#item_table tbody').empty();
        $('#form-peminjamanproses form')[0].reset();
        $('input[name=_method]').val('POST');
    }

    function edit(id){
        var save_method = 'edit';
        $('#form-peminjamanproses form')[0].reset();
        $('#form-peminjamanproses input[name=_method]').val('PATCH');
        $.ajax({
            url: "{{ url('peminjaman/register')}}/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#nip').val(data.nip);
                $('#unit_kerja').val(data.unit_kerja);
                $('#kegiatan').val(data.kegiatan.id);
                $('#tanggalPinjam').val(data.tanggalpinjamstring);
                $('#tanggalKembali').val(data.tanggalkembalistring);
                $('#kegiatan').trigger('change');
                $('#via').val(data.via);
                $('#item_table tbody').empty();
                $('.tombol-simpan').text('Ubah');
                // $('.hidden-required').removeAttr('required');
                $.each(data.peminjamandetail, function(k,val){
                    var i = k;
                    i++;
                    if(val.no_warkah == null) val.no_warkah = '';
                    if(val.jenis == null) val.jenis = '';
                    if(val.album == null) val.album = '';
                    if(val.posisi == null) val.posisi = '';
                    if(val.desa == null) val.desa = '';
                    var html = '<tr class="row'+i+'">\
                                    <td>\
                                        <input type="text" name="no_warkah['+i+']" id="no_warkah'+i+'" value="'+val.no_warkah+'" class="form-control autocompleteWarkah no_warkah" datarow="'+i+'" placeholder="Nomor Warkah" required/>\
                                        <input type="hidden" name="warkah_id['+i+']" id="warkah_id'+i+'">\
                                    </td>\
                                    <td><input type="text" name="jenis['+i+']" id="jenis'+i+'" value="'+val.jenis+'" class="form-control jenis" placeholder="Jenis Warkah" readonly/></td>\
                                    <td><input type="text" name="album['+i+']" id="album'+i+'" value="'+val.album+'" class="form-control" placeholder="Album" readonly/></td>\
                                    <td><input type="text" name="posisi['+i+']" id="posisi'+i+'" value="'+val.posisi+'" class="form-control" placeholder="Posisi" readonly/></td>\
                                    <td><select value="'+val.desa+'" class="form-control desa" name="desa['+i+']"  id="desa'+i+'""></select></td>\
                                    <td width="5%" class="text-right"><button type="button" name="remove" class= "btn btn-danger remove btn-sm"><i class="fa fa-minus"></i></button></td>\
                                </tr>';

                    $('#item_table').append(html);
                    desa(i, val.desa);
                })
                autoCompleteWarkah()
            },
            error: function () {
                alert("Terjadi kesalah, Silahkan reload!");
            }
        });
    }

    $(function () {
        $('#form-peminjamanproses form').on('submit', function (e) {
            var url;
            e.preventDefault();
                var id = $('#id').val();
                if (id == ''){
                    url = "{{ route('register.store') }}";
                }else {
                    url = "{{ url('peminjaman/register') . '/'}}" + id;
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#form-peminjamanproses form').serialize(),
                    success: function (data) {
                        $('#data-peminjaman').dataTable().api().ajax.reload();
                        toastr["success"]("Data "+data.nama+" berhasil disimpan!")
                        $('#form-peminjamanproses form')[0].reset();
                        $('input[name=_method]').val('POST');
                        $('.tombol-simpan').text('Simpan');
                        $('#item_table tbody').empty();
                    },
                    error: function () {
                        alert('Terkadi Kesalahan, Silahkan Reload');
                        // location.reload();
                    }
                });
            return false;
        });
    });

    $('#form-peminjamanproses form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });


    var Table;
    $(document).ready(function () {
        var Table;
        'use strict';
        Table = $('#data-peminjaman').DataTable({
            colReorder: true,
            processing: true,
            serverSide:true,
            ajax:"{{ url('api/peminjaman') }}",
            columns: [
                {data: 'id', className:'text-center'},
                {data: 'nama'},
                {data: 'kegiatan.nama_kegiatan'},
                {data: 'via'},
                {data: 'tanggalpinjamstring', name:'tanggal_pinjam'},
                {data: 'action',orderable:false, searchable:false},
                {data: 'tanggal_pinjam',name:'tanggal_pinjam', searchable:false, visible:false},
            ],
                columnDefs: [ {
                searchable: false,
                orderable:false,
                targets: 0
            } ],
            order: [[ 6, 'desc' ]],
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            iDisplayLength: 10,
        }),
        Table.on( 'draw.dt', function () {
            var PageInfo = $('#data-peminjaman').DataTable().page.info();
                Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
        });

    });

</script>
@endpush

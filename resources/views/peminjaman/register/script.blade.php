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

    $('#samakan-jenishak').on('click',function () {
        var jenis_hak = $('#item_table tr input.jenishak:first').val();
        if($(this).prop('checked')){
            $('.jenishak').val(jenis_hak);
        }
        else{
            $('.jenishak').val('');
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
        var i= $('#item_table tr').length;
        $(document).on('click', '.add', function(){
            // var i= 1;
            var html = '';
            html += '<tr class="row'+i+'">';
            html += '<td><input type="text" name="newno_warkah[]" id="no_warkah'+i+'" class="form-control autocompleteWarkah" data-row="'+i+'" placeholder="Nomor Warkah"/></td>';
            html += '<td><input type="text" name="newjenis[]" id="jenis'+i+'" class="form-control" placeholder="Jenis Warkah" /></td>';
            html += '<td><input type="text" name="newalbum[]" id="album'+i+'" class="form-control" placeholder="Album" /></td>';
            html += '<td><input type="text" name="newposisi[]" id="posisi'+i+'" class="form-control" placeholder="Posisi" /></td>';
            html += '<td><select class="form-control desa" name="newdesa[]"  id="desa'+i+'""></select></td>';
            html += '<td width="5%" class="text-right"><button type="button" name="remove" class= "btn btn-danger remove btn-sm"><i class="fa fa-minus"></i></button></td>';
            html += '</tr>';
            $('#item_table').append(html);
            desa(i, val='')
            autoCompleteWarkah(i)
            // $(".no_seri").focus();
            i++;
            $('.hidden-required').removeAttr('required');
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
            i--;
        });
    });
    // tidei

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
                    console.log(val)
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
                    }
                });
            },
            minLength: 2,
        });


    });

    // $(document).('.autocompleteWarkah', '')
    function autoCompleteWarkah (row) {
        var idRow = row;
        $(".autocompleteWarkah").autocomplete({
            source: function(request, response) {
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
                var idWarkah =ui.item.id;
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
                        var i =  dataWarkah.row;
                        $('#no_warkah' + i).val(dataWarkah.no_warkah);
                        $('#jenis' + i).val(dataWarkah.jenis);
                        $('#album' + i).val(dataWarkah.album);
                        $('#posisi' + i).val(dataWarkah.posisi);
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
                $('.hidden-required').removeAttr('required');
                $.each(data.peminjamandetail, function(k,val){
                    if(val.no_seri == null) val.no_seri = '';
                    if(val.no_hak == null) val.no_hak = '';
                    if(val.jenis_hak == null) val.jenis_hak = '';
                    if(val.no_ht == null) val.no_ht = '';
                    if(val.no_warkah == null) val.no_warkah = '';
                    if(val.no_su == null) val.no_su = '';
                    var html = '<tr>\
                                    <td><input type="text" name="no_seri['+val.id +'][]" id="no_seri'+i+'" value="'+ val.no_seri +'" data-type="no_seri" class="form-control" placeholder="No. Seri" /></td>\
                                    <td><input type="text" name="no_hak['+val.id+'][]" id="no_hak'+i+'" value="'+val.no_hak+'" class="form-control" placeholder="Nomor Hak" /></td>\
                                    <td><input type="text" name="jenis_hak['+val.id+'][]" id="jenis_hak'+i+'" value="'+val.jenis_hak+'" class="form-control jenishak" placeholder="Jenis Hak" /></td>\
                                    <td><select class="form-control desa" name="desa['+val.id+'][]"  id="desa'+i+'" data-i="'+i+'"></select></td>\
                                    <td><input type="text" name="no_ht['+val.id+'][]" id="no_ht'+i+'" value="'+val.no_ht+'" class="form-control" placeholder="Nomor HT"></td>\
                                    <td><input type="text" name="no_warkah['+val.id+'][]" id="no_warkah'+i+'" value="'+val.no_warkah+'" class="form-control" placeholder="Nomor Warkah" /></td>\
                                    <td><input type="text" name="no_su['+val.id+'][]" id="no_su'+i+'" value="'+val.no_su+'" class="form-control" placeholder="Nomor SU" /></td>\
                                    <td><button type="button" class= "btn btn-danger alertshow btn-sm" id="'+val.id+'" data-id="'+val.id+'" data-judul="No HAK '+val.no_hak+'" data-head="menghapus" data-type="Hapus"><i class="fa fa-minus"></i></button></td>\
                                </tr>';
                    $('#item_table').append(html);
                    desa(i, val.desa +', '+ val.kecamatan);
                    i++;
                })
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
                        location.reload();
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

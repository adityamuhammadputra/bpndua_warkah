@push('scripts')
<script>
    var newUrl, Tablee;
     var rows_selected = [], rowId;

    $('.alertshow').on('click', function(){
        $('.globalalertnotif').text($(this).data('type'))
        $('.globalalerthead').text('Apakah anda yakin akan '+$(this).data('head')+' data ?');
        $('#globalalert').show();
        $('.alert-form').find('.btn-primary').hide();
        $('#submitpeminjamanvalidasi').show();
        $('.alert-form').find('#submitpeminjamanvalidasi').prop('disabled', false);
        $('.alert-form').find('#submitpeminjamanvalidasi').html('Ya!');
    })

    $('#submitpeminjamanvalidasi').click(function(){
        $('.form-pengembalian-validasi').submit();
    })

    $('.form-pengembalian-validasi').on('submit', function(e){
        $.ajax({
            url: "{{ url('pengembalian/validasi') }}",
            type: "POST",
            data: $(this).serialize()+'&checbox='+rows_selected,
            beforeSend: function() {
                $('.alert-form').find('#submitpeminjamanvalidasi').prop('disabled', true);
                $('.alert-form').find('#submitpeminjamanvalidasi').html('Loading...');
            },
            success: function(data){
                    $('#data-pengembalianvalidasi').dataTable().api().ajax.reload();
                    $('.form-pengembalian-validasi')[0].reset();
                    toastr["success"]("Data "+data+" berhasil di Valdasi dan akan masuk History!")
                    $('#globalalert').hide();

            },
            error: function(){
                alert('Terjadi kesalahan, silahkan reload atau data yg anda kirim kosong');
                location.reload();
            }
        })
        return false;
    })

    $('#kegiatan').on('change', function(){
        var kegiatan = $('#kegiatan').val();
        newUrl  = "{{ url('api/pengembalianvalidasi') }}?kegiatan_id=" + kegiatan;
        $('#data-pengembalianvalidasi').DataTable().ajax.url(newUrl).load();
        // if(kegiatan == '') {
        //     $("[name='data-pengembalianvalidasi_length']").val('25').trigger('change');}
        // else{
        // $("[name='data-pengembalianvalidasi_length']").val('-1').trigger('change');}
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        'use strict';
        Tablee = $('#data-pengembalianvalidasi').DataTable({
            dom:"<'row posisi'B>lftip",
            buttons: [{
                extend:'excel',
                filename: 'PengembalianVallidasi',
                autoFilter: true,
                text: '<i class = "fa fa-file-excel-o"> Export Excel</i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                },
            }],
            colReorder: true,
            processing: true,
            serverSide:true,
            ajax:{
                "url": "{{ url('api/pengembalianvalidasi') }}",
                "type": 'POST',
            },
            columns: [
                {data: 'id',className:'text-center'},
                {data: 'peminjamans.nama'},
                {data: 'peminjamans.via'},
                {data: 'kegiatans.nama_kegiatan'},
                {data: 'no_warkah'},
                {data: 'jenis'},
                {data: 'album'},
                {data: 'posisi'},
                {data: 'desa'},
                {data: 'tanggalpinjamstring', name:'tanggal_pinjam'},
                {data: 'tanggaltempostring',name:'tanggal_jatuh_tempo'},
                {
                    data:'id', searchable:false, orderable:false,
                    render:function(data, type,row){
                        return '<div class="checkbox"><input type="checkbox" class="dt-checkboxes" value="'+data+'"><label></label></div>';
                    },
                    'checkboxes': {
                        'selectRow': true
                    }
                },
                {data: 'tanggal_pinjam', searchable:false, visible:false},
            ],
            order: [[ 12, 'desc' ]],
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            iDisplayLength: 25,
             'select': {
                'style': 'multi'
            },
            rowCallback: function( row, data, index ) {
                if ( data.tanggalpinjamlima <= moment().format('YYYYMMDD'))
                {
                    $('td', row).css('background-color', '#f2dede');
                }else if(data.tanggalpinjamtiga <= moment().format('YYYYMMDD')){
                    $('td', row).css('background-color', '#fcf8e3');
                }

                rowId = data.id;
                if($.inArray(rowId, rows_selected) !== -1){
                    $(row).addClass('row_selected');
                }
            }
        });
        yadcf.init(Tablee, [
            {
                column_number: 4,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "No Warkah"
            },
            {
                column_number: 8,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "Desa Kecamatan"
            },
        ]);
        Tablee.on( 'draw.dt', function () {
            var PageInfo = $('#data-pengembalianvalidasi').DataTable().page.info();
                Tablee.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
        });

    });


    //
     $(document).on('change','.dt-checkboxes', function(){
        var index = $.inArray(rowId, rows_selected);
        if($(this).is(':checked')){
            $(this).closest('tr').addClass('row_selected');
            rows_selected.push($(this).val());
        }else{
            $(this).closest('tr').removeClass('row_selected');
        // rows_selected.($(this).val());
            var remove_Item = $(this).val();
            rows_selected = $.grep(rows_selected, function(value) {
                    return value != remove_Item;
            });
        }

    })

    $(document).ready(function () {
        $(".dt-checkboxes-select-all").html('');
    })

</script>
@endpush


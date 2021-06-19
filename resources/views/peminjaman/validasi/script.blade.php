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
        $('.alert-form').find('.btn-success').prop('disabled', false);
        $('.alert-form').find('.btn-success').html('Ya!');

    })

    $('#submitpeminjamanvalidasi').click(function(){
        $('.form-peminjaman-validasi').submit();
    })

    $('.form-peminjaman-validasi').on('submit', function(e){
        $.ajax({
            url: "{{ url('peminjaman/validasi') }}",
            type: "POST",
            data: $(this).serialize()+'&checbox='+rows_selected,
            beforeSend: function() {
                $('.alert-form').find('.btn-success').prop('disabled', true);
                $('.alert-form').find('.btn-success').html('Loading...');

            },
            success: function(data){
                    $('#data-peminjamanvalidasi').dataTable().api().ajax.reload();
                    $('.form-peminjaman-validasi')[0].reset();
                    toastr["success"]("Data "+data+" berhasil divaldasi !")
                    $('#globalalert').hide();

            },
            error: function(){
                alert('Terjadi kesalahan, silahkan reload atau data yg anda kirim kosong');
                // location.reload();
            }
        })
        return false;
    })

    $('#kegiatan, #hari_lewat').on('change', function(){
        var kegiatan = $('#kegiatan').val();
        var hari_lewat = $('#hari_lewat').val();
        newUrl  = "{{ url('api/peminjamanvalidasi') }}?kegiatan_id=" + kegiatan + "&hari_lewat=" + hari_lewat;
        $('#data-peminjamanvalidasi').DataTable().ajax.url(newUrl).load();
        // if(kegiatan == '' && hari_lewat == '') {
        //     $("[name='data-peminjamanvalidasi_length']").val('25').trigger('change');}
        // else{
        // $("[name='data-peminjamanvalidasi_length']").val('-1').trigger('change');}
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        'use strict';
        Tablee = $('#data-peminjamanvalidasi').DataTable({
            dom:"<'posisi'B>lftip",
            buttons: [{
                extend:'excel',
                filename: 'PeminjamanVallidasi',
                autoFilter: true,
                text: '<i class = "fa fa-file-excel-o"> Export Excel</i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                },
            }],
            colReorder: true,
            processing: true,
            serverSide:true,
            ajax:{
                "url": "{{ url('api/peminjamanvalidasi') }}",
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
                {data: 'desa',
                    // render: function(data, type,row){
                    //     return data + ' / '+row.kecamatan;
                    // }
                },
                {data: 'tanggalpinjamstring', name:'tanggal_pinjam'},
                // {data: 'action',orderable:false, searchable:false, className:'text-center'},
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
                columnDefs: [ {
                searchable: false,
                orderable:false,
                targets: 0
            } ],
            order: [[ 11, 'desc' ]],
            'select': {
                'style': 'multi'
            },
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            iDisplayLength: 25,
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
                filter_default_label: "Desa kecamatan"
            },
        ]);

        Tablee.on( 'draw.dt', function () {
            var PageInfo = $('#data-peminjamanvalidasi').DataTable().page.info();
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


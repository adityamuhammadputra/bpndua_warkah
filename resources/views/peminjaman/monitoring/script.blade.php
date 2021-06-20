@push('scripts')
<script>
    var newUrl, Tablee;

    $('#kegiatan, #status, #tanggal_selesai, #tanggal_mulai').on('change dp.change', function(){
        var kegiatan = $('#kegiatan').val();
        var status = $('#status').val();
        var mulai = $('#tanggal_mulai').val();
        var selesai = $('#tanggal_selesai').val();
        newUrl  = "{{ url('api/peminjamanmonitoring') }}?kegiatan_id=" + kegiatan + "&status=" + status + "&mulai=" + mulai + "&selesai=" + selesai;
        $('#data-peminjamanmonitoring').DataTable().ajax.url(newUrl).load();
        // if(kegiatan == '' && status == '') {
        //     $("[name='data-peminjamanmonitoring_length']").val('25').trigger('change');}
        // else{
        // $("[name='data-peminjamanmonitoring_length']").val('25').trigger('change');}
    });

    $(document).ready(function () {
        $(function() {
            $('#tanggal_mulai, #tanggal_selesai').datetimepicker({
                format:'DD/MM/YYYY'
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        'use strict';
        Tablee = $('#data-peminjamanmonitoring').DataTable({
            dom:"<'row posisi'B>lftip",
            buttons: [{
                extend:'excel',
                filename: 'PeminjamanVallidasi',
                autoFilter: true,
                text: '<i class = "fa fa-file-excel-o"> Export Excel</i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                },
                // action: function ( e, dt, node, config ) {
                //     $("[name='data-peminjamanmonitoring_length']").val('-1').trigger('change');
                //     $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, node, config);
                // }
            }],
            colReorder: true,
            processing: true,
            serverSide:true,
            ajax:{
                "url": "{{ url('api/peminjamanmonitoring') }}",
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
                {data: 'tanggalkembalistring',name:'tanggal_kembali'},
                {data: 'action',orderable:false, searchable:false, className:'text-center'},
                {data: 'updated_at', searchable:false, visible:false},
            ],
                columnDefs: [ {

                targets: 0
            } ],
            order: [[ 13, 'desc' ]],
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            iDisplayLength: 25,
            rowCallback: function( row, data, index ) {
                @if (request()->w)
                    $('#yadcf-filter--data-peminjamanmonitoring-4').val('1237/2021').keyup();
                @endif
                // if ( data.tanggalpinjamlima <= moment().format('YYYYMMDD') && data.status != 4)
                if ( data.tanggaljatuhtempoorder <= moment().format('YYYYMMDD') && data.status != 4)
                {
                    $('td', row).css('background-color', '#f2dede');
                }else if(data.tanggalpinjamtiga <= moment().format('YYYYMMDD') && data.status != 4){
                    $('td', row).css('background-color', '#fcf8e3');
                }
            }
        });
        yadcf.init(Tablee, [
            {
                column_number: 4,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "No Warkah",
                // warkahPinjam
            },
            {
                column_number: 8,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "Desa Kecamatan"
            },
        ]);
        Tablee.on( 'draw.dt', function () {
            var PageInfo = $('#data-peminjamanmonitoring').DataTable().page.info();
                Tablee.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
        });

        setInterval( function () {
            Tablee.ajax.reload( null, false ); // user paging is not reset on reload
        }, 5000 );
        // $('.page-container').addClass('page-navigation-toggled');


    });


    // $(function () {
    //     var selectors = [
    //         ":lt(2)",
    //         ":gt(10)"
    //     ];
    //     var $tableslide = $("#data-peminjamanmonitoring").children(selectors[1]).hide().end();
    //     var state = false;
    //     setInterval(function () {
    //         var s = state;
    //         $tableslide.children(selectors[+s]).fadeOut().promise().then(function () {
    //             $tableslide.children(selectors[+!s]).fadeIn();
    //         });
    //         state = !state;
    //     }, 3000);
    // });

</script>
@endpush


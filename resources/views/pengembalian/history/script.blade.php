@push('scripts')
<script>
    var newUrl, Tablee;

    $('#kegiatan, #status, #tanggal_selesai, #tanggal_mulai').on('change dp.change', function(){
        var kegiatan = $('#kegiatan').val();
        var mulai = $('#tanggal_mulai').val();
        var selesai = $('#tanggal_selesai').val();
        newUrl  = "{{ url('api/pengembalianhistory') }}?kegiatan_id=" + kegiatan + "&mulai=" + mulai + "&selesai=" + selesai;
        $('#data-kembali').DataTable().ajax.url(newUrl).load();
        // if(kegiatan == '' && status == '') {
        //     $("[name='data-kembali_length']").val('25').trigger('change');}
        // else{
        // $("[name='data-kembali_length']").val('-1').trigger('change');}
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
        Tablee = $('#data-kembali').DataTable({
            dom:"<'row posisi'B>lftip",
            buttons: [{
                extend:'excel',
                filename: 'PengembalianHistory',
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
                "url": "{{ url('api/pengembalianhistory') }}",
                "type": 'POST',
            },
            columns: [
                {data: 'id', className:'text-center'},
                {data: 'peminjamans.nama'},
                {data: 'peminjamans.via'},
                {data: 'kegiatans.nama_kegiatan'},
                {
                    data: 'no_hak',
                    render: function(data, type, row){
                        return data + ' / '+row.jenis_hak;
                    }
                },
                {
                    data: 'desa',
                    render: function(data, type,row){
                        return data + ' / '+row.kecamatan;
                    }
                },
                {data: 'no_ht'},
                {data: 'no_su'},
                {data: 'no_warkah'},
                {data: 'tanggalpinjamstring', name:'tanggal_pinjam'},
                {data: 'tanggalkembalistring', nama:'tanggal_kembali'},
                {data: 'action',orderable:false, searchable:false, className:'text-center'},
                {data: 'tanggal_kembali', searchable:false, visible:false},
            ],
                columnDefs: [ {
                searchable: false,
                orderable:false,
                targets: 0
            } ],
            order: [[ 12, 'desc' ]],
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            iDisplayLength: 25,
        }),
        Tablee.on( 'draw.dt', function () {
            var PageInfo = $('#data-kembali').DataTable().page.info();
                Tablee.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
        });

    });

</script>
@endpush


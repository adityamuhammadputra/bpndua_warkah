@push('scripts')
    <script>
         var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-role').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ url('api/userrole') }}",
                columns: [
                    {data: null },
                    {data: 'name',name:'name'},
                    {data: 'guard_name',name:'guard_name'},
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false,
                    targets: 0
                } ],
                order: [[ 1, 'asc' ]],

                aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
                iDisplayLength: 25
            }),


             Table.on( 'draw.dt', function () {
                var PageInfo = $('#data-role').DataTable().page.info();
                     Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    } );
                } );
        });

        function editData(id){
            $('#id').val(id);
            $('#form form')[0].reset();
            $.ajax({
                url: "{{ url('userrole')}}/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#name').val(data.name);
                },
                error: function () {
                    alert("Terjadi kesalahan, silahkan reload");
                }
            });
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('userrole')}}/" + id,
                type: "POST",
                data: {'_method': 'DELETE','_token': csrf_token
                },
                success: function(data) {
                    $('#data-role').dataTable().api().ajax.reload();
                    $('#form form')[0].reset();
                    toastr["success"]("Role "+data+" berhasil dihapus !")
                },
                error: function () {
                   alert(error);
                }
            });
        }
    </script>
@endpush

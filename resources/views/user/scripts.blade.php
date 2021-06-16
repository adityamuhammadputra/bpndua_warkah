@push('scripts')
<script>
 $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#form-user').on('submit', function (e) {
        var url, id = $('#id').val();
        e.preventDefault();
        if(id == '') url = "{{ url('user') }}";
        else url = "{{ url('user') }}/" + id;
        $.ajax({
            url:url,
            type:'POST',
            data:new FormData($(this)[0]),
            beforeSend: function(){
                $('.btn-kirim').html('loading...')
                $('.btn-kirim').attr('disabled', true)
            },
            contentType: false,
            processData: false,
            success: function (data) {
                toastr["success"]('User '+data+' Berhasil')
                $('#data-user').dataTable().api().ajax.reload()
                $('#form-user')[0].reset()
                $('.btn-kirim').html('kirim')

            }
        })
        return false;
    })




    'use strict';
    Tablee = $('#data-user').DataTable({
        colReorder: true,
        processing: true,
        serverSide:true,
        ajax:{
            "url": "{{ url('api/user') }}",
            "type": 'POST',
        },
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'jabatan'},
            {data: 'akses'},
            {data: 'show_photo',name:'show_photo', searchable:false, orderable:false},
            {data: 'action',name:'action',orderable:false, searchable:false}
        ],
        order: [[ 1, 'desc' ]],
        aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
        iDisplayLength: 25,
    }),
    Tablee.on( 'draw.dt', function () {
        var PageInfo = $('#data-user').DataTable().page.info();
            Tablee.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

});

$('#password').blur(function () {
        if($(this).val()){
            $('#passwordagain').attr('required',true);
        }else{
            $('#passwordagain').attr('required',false);
        }
    })

$(document).ready(function () {
   $("#passwordagain, #password").blur(checkpass);
});

function checkpass() {
    var password = $("#password").val();
    var confirmPassword = $("#passwordagain").val();
    if (password != confirmPassword){
        $('#passerror').html('')
        $('#passerror').append('<a class="text-danger"><i class="fa fa-warning"></i> Password tidak sama</a>')
        $('.btn-kirim').attr('disabled', true)
    }else if(password.length < 8){
        $('#passerror').html('')
        $('#passerror').append('<a class="text-danger"><i class="fa fa-warning"></i> Password kurang dari 8 karakter</a>')
        $('.btn-kirim').attr('disabled', true)
    }
    else{
        $('#passerror').html('')
        $('#passerror').append('<a class="text-success"><i class="fa fa-check-circle-o"></i> Password cocok</a>');
        $('.btn-kirim').attr('disabled', false)

    }

}
    $('#email').blur(function () {
        var email = $(this).val().replace(/[^A-Z0-9]/ig, "");
        var oldemail = $('#oldemail').val();
        $('#email').val(email);
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('api/cekusers') }}",
            method: "POST",
            data:{email:email,_token:_token,oldemail:oldemail},
            success: function (data) {
                if(data == 'ada'){
                    $('#usernameerror').html('');
                    $('#usernameerror').append('<a class="text-danger"><i class="fa fa-warning"></i> Username sudah digunakan</a>');
                    $('.form-username').addClass('has-error has-danger');
                    $('.btn-kirim').attr('disabled', true);
                }
                else{
                    $('#usernameerror').html('');
                    $('#usernameerror').append('<a class="text-success"><i class="fa fa-check-circle-o"></i> Username dapat digunakan</a>');
                    $('.btn-kirim').attr('disabled', false);
                }

            }
        });
    })

function editForm(id) {
    $('.checkbox').removeAttr('checked');
    $('input[name=_method]').val('PATCH');
    $('#form-user')[0].reset();
    $.ajax({
        url: "{{ url('user')}}/" + id + "/edit", //menampilkan data dari controller edit
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit User');

            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#oldemail').val(data.email);
            $('#password').val(data.password);
            $('#jabatan').val(data.jabatan);
            $('#photo').attr('required',false);
            $.each(data.roles, function( key, value) {
                $('#cekbox'+value.id).attr('checked','checkbox');
                $('#cekbox'+value.id).closest('label').find('.icheckbox_minimal-grey').addClass('checked');
            });

            $('#email').focus();

        },

        error: function () {
            alert("Data tidak ada");
        }

    });
}

function deleteData(id) {
    $.ajax({
        type:'DELETE',
        url:"{{ url('user') }}/" + id,
        success: function(data){
            toastr["success"]('User berhasil dihapus')
            $('#data-user').dataTable().api().ajax.reload()
        },
        error:function(){
            alert(error);
        }
    })

}
</script>
@endpush


<form method="post" data-toogle="validator" class="form-horzontal" id="form-user" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field ('POST')}}
    <div class="modal-body">
    <input type="hidden" name="id" id="id">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="control-label">Nama</label>
                <input type="text" class="form-control" name="name" id="name" required>
                <span class="help-block with-errors"></span>
            </div>

            <div class="form-group">
                <label for="email" class="control-label">Username</label>
                <input type="text" name="email" id="email" class="form-control" required>
                <input id="oldemail" type="hidden">
                <span class="help-block with-errors" id="usernameerror"></span>
            </div>
            <div class="form-group">
                <label for="foto" class="control-label">Foto</label>
                <input type="file" name="foto" id="photo" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="passwordagain" class="control-label">Konfirmasi Password Baru</label>
                <input type="password" name="" id="passwordagain" onchange="checkpass()" class="form-control">
                <span class="help-block with-errors" id="passerror"></span>

            </div>
            <div class="form-group">
                <label for="passwordagain" class="control-label">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="border-top: 1px solid gainsboro;margin-top: 10px;padding-top: 10px;">
            <div class="form-group">
                <label for="password" class="control-label">Hak Akses / Role</label> <br>
            </div>
        </div>
    </div>
    @foreach ($data as $role)
    <div class="col-md-4">
        <div class="form-group">
            <label class="check" for="cekbox{{ $role->id }}">
                <input type="checkbox" class="inp-cbx checkbox icheckbox" name="role[]" value="{{ $role->name }}" id="cekbox{{ $role->id }}">
                {{ $role->name }}
            </label>
        </div>
        </div>
    @endforeach
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="button" class="btn btn-default btn-save" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-kirim">Kirim</button>
            </div>
        </div>
    </div>
</form>
<br><br>

@extends("layouts/master")

@section("title","Manajemen User")

@section("sidebar")
    <li>
        <a href="{{ route('main') }}">
            <i class="ti-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="">
        <a href="{{ route('berita') }}">
            <i class="fas fa-newspaper"></i>
            <p>Berita</p>
        </a>
    </li>
    <li class="">
        <a href="{{ route('rapot') }}">
            <i class="fas fa-book"></i>
            <p>RAPOT ANAK</p>
        </a>
    </li>
    @if (session()->get('roles') == 'admin')
    <li class="">
        <a href="{{ route('posyandu') }}">
            <i class="fas fa-hospital"></i>
            <p>POSYANDU</p>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('user') }}">
            <i class="fas fa-user"></i>
            <p>MANAJEMEN USER</p>
        </a>
    </li>
    @endif
@endsection
@section("content")
<div class="col-md-12">
    <div class="card card-plain">
        <div class="header row">
            <div class="col-lg-10">
                <h4 class="title"><b>Ubah Posyandu</b></h4>
            </div>
        </div>
        <hr/>
        <div>
            <form action="{{ url('/user_edit/update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="nomor">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" style="border:1px solid #f1f1f1;" >
                </div>
                <div class="form-group">
                    <label for="nomor">Email</label>
                    <input type="email" name="email" id="email" class="form-control" style="border:1px solid #f1f1f1;" >
                </div>
                <div class="form-group">
                    <label for="nomor">Password</label>
                    <input type="password" id="password" name="password" class="form-control" style="border:1px solid #f1f1f1;" >
                </div>
                <div class="form-group" id="thumb">
                    <label for="nomor">Foto Thumbnail</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nomor">Roles</label>
                    <select name="roles" class="form-control" id="roles">
                        <option value="">-- Pilih Roles --</option>
                        <option value="kader">Kader Posyandu</option>
                        <option value="orangtua">Orang Tua</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$id}}">
                <button class="btn btn-primary active" style="border-radius:0;">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
$(document).ready(function() {
    // CKEDITOR.replace( 'ckeditor' );
    
    $.ajax({
        url: "{{config('app.api_url')}}"+"user/{{$id}}",
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function (data) {
            $('#name').val(data.user.name);
            $('#email').val(data.user.email);
            $('#roles').val(data.user.roles);
            $('#thumb').append(`<img src="${data.user.photo}" style="width: 250px; margin: 20px 0px 0px 0px;">`);
        }
    });     
});
</script>
@endsection
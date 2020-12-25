@extends('layouts.main')

@section('title', 'Trash Bag')

@section('container')
    
<!-- BREADCRUMB-->
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<!-- STATISTIC-->
<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-user"></i>
                            <strong class="card-title pl-2">Profile Card</strong>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <img class="mx-auto d-block image img-cir img-120" src="{{ Auth::user()->foto_profil }}" alt="Card image cap">
                                <h4 class="text-sm-center mt-2 mb-1">{{ Auth::user()->nama_lengkap }}</h4>
                                <div class="location text-sm-center">
                                    <i class="fa fa-at"></i> {{ Auth::user()->email }}</div>
                            </div>
                            <hr>
                            <div class="card-text text-sm-center">
                                <form action="{{ url('user/editFoto/'.Auth::user()->id) }}" method="post" id="formFoto" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="file" name="foto_profil" id="foto_profil" style="display: none">
                                    <label for="foto_profil" class="btn btn-outline-primary">Ganti Foto Profil</label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="au-card mb-3">
                        <div class="au-card-inner">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="col-2">Nama</td>
                                        <td class="col">{{ Auth::user()->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">Email</td>
                                        <td class="col">{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">No. Telepon</td>
                                        <td class="col">{{ Auth::user()->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">Alamat</td>
                                        <td class="col">{{ Auth::user()->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">Level User</td>
                                        @if (Auth::user()->role == '5')
                                            <td class="col">Super Admin</td>
                                        @else
                                            <td class="col">Bendahara</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-success btnEdit" data-id="{{ Auth::user()->id }}"  data-toggle="modal" data-target="#scrollmodal" style="width: 70px">Edit</button>
                        <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#passwordForm" >Ubah Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->

<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal" id="formEdit">
                    @csrf
                    @method('put')
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nama" class=" form-control-label">Nama Lengkap</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email" class=" form-control-label">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="no_telepon" class=" form-control-label">No. Telepon</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="no_telepon" name="no_telepon" placeholder="No. Telepon" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="alamat" class=" form-control-label">Alamat</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="alamat" id="alamat" rows="5" placeholder="Content..." class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
        </div>
    </div>
</div>

<div class="modal fade" id="passwordForm" tabindex="-1" role="dialog" aria-labelledby="passwordForm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('user/resetPass/'.Auth::user()->id) }}" method="post" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="oldPassword" class="pr-1  form-control-label">Old Password</label>
                        <input type="password" name="oldPassword" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="pr-1  form-control-label">New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword" class="pr-1  form-control-label">Confirmation Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#foto_profil').change(function(){
                $('#formFoto').submit();
            });

            $('.btnEdit').on('click', function(){
                const id = $(this).data('id');
                $('#formEdit').attr('action', id);
                $.ajax({
                    url:id,
                    method: 'get', 
                    dataType: 'json',
                    success:function(data){
                        $('#nama').val(data.nama_lengkap);
                        $('#email').val(data.email);
                        $('#no_telepon').val(data.no_telepon);
                        $('#alamat').val(data.alamat);
                    }
                });
            })
        });
    </script>
@endsection
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
                                <li class="list-inline-item">Pengurus</li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Edit Data Pengurus</li>
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
            <form action="{{ url('pengurus/'.$pengurus->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-user"></i>
                                <strong class="card-title pl-2">Foto Profile</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="mx-auto d-block image img-cir img-120" src="{{ $pengurus->foto_profil }}" alt="Card image cap" id="display">
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">
                                    <input type="file" name="foto_profil" id="foto_profil" style="display: none">
                                    <label for="foto_profil" class="btn btn-outline-primary">Pilih Foto</label>
                                    @error('foto_profil')
                                        <span style="display: block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body card-block">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="nama" class=" form-control-label">Nama Lengkap</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ (old('nama'))?old('nama'):$pengurus->nama_lengkap }}">
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="no_telepon" class=" form-control-label">No. Telepon</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="no_telepon" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ (old('no_telepon'))?old('no_telepon'):$pengurus->no_telepon }}">
                                            @error('no_telepon')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="email" class=" form-control-label">Email</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ (old('email'))?old('email'):$pengurus->email }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="alamat" class=" form-control-label">Alamat</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea name="alamat" id="alamat" rows="9" class="form-control @error('alamat') is-invalid @enderror">{{ (old('alamat')?old('alamat'):$pengurus->alamat) }}</textarea>
                                            @error('alamat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="role" class=" form-control-label">Level User</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                                <option value="">Please select</option>
                                                <option value="2"{{ ($pengurus->role == 2)?'selected':'' }}>Pengurus 1</option>
                                                <option value="3" {{ ($pengurus->role == 3)?'selected':'' }}>Pengurus 2</option>
                                                <option value="4" {{ ($pengurus->role == 4)?'selected':'' }}>Bendahara</option>
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <strong class="card-title pt-5 pb-2">Ubah Password</strong>
                                    <small id="passHelp" class="form-text text-muted">Silahkan isi field input jika ingin mengubah password</small>
                                    <div class="row form-group pt-3">
                                        <div class="col col-md-3">
                                            <label for="password" class=" form-control-label">Password</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="passHelp">
                                            <small id="passHelp" class="form-text text-muted"></small>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="password_confirmation" class=" form-control-label">Confirmasi Password</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-dot-circle-o"></i> Simpan
                                </button>
                                <a href="{{ url('pengurus') }}" class="btn btn-danger">
                                    <i class="fa fa-ban"></i> Cencel
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- END STATISTIC-->

@endsection

@section('script')

<script>
    $(document).ready(function(){
        $('#foto_profil').change(function(){
            const file = this.files[0];

            if(file){
                const reader = new FileReader();

                reader.addEventListener("load", function(){
                    document.getElementById('display').setAttribute('src', this.result);
                });
                
                reader.readAsDataURL(file);
            }
        });
    });
</script>
    
@endsection
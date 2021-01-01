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
                                <li class="list-inline-item">Jenis Sampah</li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Tambah Data Jenis Sampah</li>
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
            <form action="{{ url('jenis') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-user"></i>
                                <strong class="card-title pl-2">Foto</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="mx-auto d-block image img-cir img-120" src="{{ asset('images/no_image.png') }}" alt="Card image cap" id="display">
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">
                                    <input type="file" name="gambar" id="gambar" style="display: none">
                                    <label for="gambar" class="btn btn-outline-primary">Pilih Foto</label>
                                    @error('gambar')
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
                                            <label for="jenis_sampah" class=" form-control-label">Jenis Sampah</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="jenis_sampah" name="jenis_sampah" class="form-control @error('jenis_sampah') is-invalid @enderror" value="{{ old('jenis_sampah') }}">
                                            @error('jenis_sampah')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="harga" class=" form-control-label">Harga/kg</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="number" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                                            @error('harga')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Simpan
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
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
        $('#gambar').change(function(){
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
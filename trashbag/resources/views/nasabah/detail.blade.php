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
            <h3 class="title-5">Detail data nasabah</h3>
            <div class="table-data__tool">
                <div class="table-data__tool-right">
                    <a href="{{ url('nasabah') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="fas fa-arrow-left"></i>Kembali</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-user"></i>
                            <strong class="card-title pl-2">Profile Card</strong>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <img class="mx-auto d-block image img-cir img-120" src="{{ $nasabah->foto_profil }}" alt="Card image cap">
                                <h4 class="text-sm-center mt-2 mb-1">{{ $nasabah->nama_lengkap }}</h4>
                                <div class="location text-sm-center">
                                   {{ $nasabah->email }}</div>
                            </div>
                            <hr>
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
                                        <td class="col">{{ $nasabah->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">Email</td>
                                        <td class="col">{{ $nasabah->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">No. Telepon</td>
                                        <td class="col">{{ $nasabah->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">Alamat</td>
                                        <td class="col">{{ $nasabah->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"></td>
                                        <td class="col">
                                            <a href="" class="btn btn-outline-primary">Buku Tabungan</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->
@endsection
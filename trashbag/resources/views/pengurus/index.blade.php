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
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Data Pengurus</h3>
                    <div class="table-data__tool d-flex flex-row-reverse">
                        <div class="table-data__tool-right">
                            <a href="{{ url('pengurus/create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add user</a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th></th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pengurus->count() == 0)
                                    <tr>
                                        <td colspan="6" style="text-align: center">Belum ada data</td>
                                    </tr>
                                @else
                                    @foreach ($pengurus as $key => $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $pengurus->firstItem()+$key }}</td>
                                        <td>
                                            <img class="mx-auto d-block image img-cir img-120" src="{{ $item->foto_profil }}" alt="">
                                        </td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ url('pengurus/'.$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-info"></i>
                                                </a>
                                                <a href="{{ url('pengurus/'.$item->id.'/edit') }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <form action="{{ url('pengurus/'.$item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    
                                                    <button type="submit" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->

                    {{ $pengurus->links('vendor.pagination.default') }}

                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->

@endsection
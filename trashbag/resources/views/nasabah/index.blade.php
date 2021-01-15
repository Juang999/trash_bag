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
                                <li class="list-inline-item">Nasabah</li>
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
                    <h3 class="title-5 m-b-35">Data Nasabah</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                        </div>
                        @if (Auth::user()->role == 5)
                            
                        <div class="table-data__tool-right">
                            <a href="{{ url('nasabah/create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add user</a>
                        </div>
                        @endif
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 display" id="table_id">
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
                                @if ($nasabah->count() == 0)
                                    <tr>
                                        <td colspan="6" style="text-align: center">Belum ada data</td>
                                    </tr>
                                @else
                                    @foreach ($nasabah as $key => $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <img class="mx-auto d-block image img-cir img-120" src="{{ $item->foto_profil }}" alt="">
                                        </td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->role == 4)
                                                    <a href="{{ url('nasabah/buku/'.$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Buku Tabungan">
                                                        <i class="fas fa-credit-card"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ url('nasabah/'.$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-info"></i>
                                                </a>
                                                @if (Auth::user()->role == 5)
                                                <a href="{{ url('nasabah/'.$item->id.'/edit') }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a href="{{ url('nasabah/delete/'.$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var table = $('#table_id').DataTable({
                columnDefs: [
                    { orderable: false, targets: [1,5] }
                ]
            });
        });
    </script>
@endsection
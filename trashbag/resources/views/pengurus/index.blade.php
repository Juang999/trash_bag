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
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ url('pengurus/create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add user</a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table id="table_id" class="table table-data2 display">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th></th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Lev. User</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pengurus as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img class="mx-auto d-block image img-cir img-120" src="{{ $item->foto_profil }}" alt=""></td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>
                                            @if ($item->role == 2)
                                                Pengurus 1
                                            @elseif($item->role == 3)
                                                Pengurus 2
                                            @else
                                                Bendahara
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ url('pengurus/'.$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-info"></i>
                                                </a>
                                                <a href="{{ url('pengurus/'.$item->id.'/edit') }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a href="{{ url('pengurus/delete/'.$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
            $('#table_id').DataTable();
        });
        // function tableFilter(){
        //     var input, filter, table, tr, td, i;
        //     input  = document.getElementById('select1');
        //     filter = input.value.toUpperCase();
        //     table = document.getElementById('tabelPengurus');
        //     tr = table.getElementsByTagName('tr');
        //     for(i = 0; i< tr.length; i++){
        //         td = tr[i].getElementsByTagName('td')[5];
        //         if(td){
        //             if(td.innerHTML.toUpperCase().indexOf(filter) > -1){
        //                 tr[i].style.display = "";
        //             }else{
        //                 tr[i].style.display = "none";
        //             }
        //         }
        //     }
        // }

        // $('#cari').on('keypress', 13, function(){
        //     tableFilterCari();
        // })

        // function tableFilterCari(){
        //     var input, filter, table, tr, td, i;
        //     input  = document.getElementById('cari');
        //     filter = input.value.toUpperCase();
        //     table = document.getElementById('tabelPengurus');
        //     tr = table.getElementsByTagName('tr');
        //     for(i = 0; i< tr.length; i++){
        //         td = tr[i].getElementsByTagName('td')[2];
        //         if(td){
        //             if(td.innerHTML.toUpperCase().indexOf(filter) > -1){
        //                 tr[i].style.display = "";
        //             }else{
        //                 tr[i].style.display = "none";
        //             }
        //         }
        //     }
        // }
    </script>
@endsection
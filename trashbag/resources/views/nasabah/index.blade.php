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
                    <h3 class="title-5 m-b-35">Data Pengurus</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--lg">
                                <div class="input-group mb-3">
                                    <input type="text" id="cari" class="form-control" placeholder="Search.." aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="tableFilterCari()">Button</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ url('nasabah/create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add user</a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2" id="dataTable">
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
                                                <a href="{{ url('nasabah/'.$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-info"></i>
                                                </a>
                                                <a href="{{ url('nasabah/'.$item->id.'/edit') }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <form action="{{ url('nasabah/'.$item->id) }}" method="post">
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

                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->

@endsection

@section('script')
    <script>

        $('#cari').on('keypress', 13, function(){
            tableFilterCari();
        })

        function tableFilterCari(){
            var input, filter, table, tr, td, i;
            input  = document.getElementById('cari');
            filter = input.value.toUpperCase();
            table = document.getElementById('dataTable');
            tr = table.getElementsByTagName('tr');
            for(i = 0; i< tr.length; i++){
                td = tr[i].getElementsByTagName('td')[2];
                if(td){
                    if(td.innerHTML.toUpperCase().indexOf(filter) > -1){
                        tr[i].style.display = "";
                    }else{
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
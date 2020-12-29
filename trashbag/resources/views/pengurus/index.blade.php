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
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="property" id="select1" onchange="tableFilter()">
                                    <option value="">Pilih level user</option>
                                    <option value="Pengurus 1">Pengurus 1</option>
                                    <option value="Pengurus 2">Pengurus 2</option>
                                    <option value="Bendahara">Bendahara</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs-select2--light rs-select2--sm">
                                <select class="js-select2" name="time">
                                    <option selected="selected">Today</option>
                                    <option value="">3 Days</option>
                                    <option value="">1 Week</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <button class="au-btn-filter">
                                <i class="zmdi zmdi-filter-list"></i>filters</button>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ url('pengurus/create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add user</a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2" id="tabelPengurus">
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
                                            @if ($item->role == 2)
                                                Pengurus 1 (Setoran)
                                            @elseif ($item->role == 3)
                                                Pengurus 2 (Penjualan)
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

@section('script')
    <script>

        function tableFilter(){
            var input, filter, table, tr, td, i;
            input  = document.getElementById('select1');
            filter = input.value.toUpperCase();
            table = document.getElementById('tabelPengurus');
            tr = table.getElementsByTagName('tr');
            for(i = 0; i< tr.length; i++){
                td = tr[i].getElementsByTagName('td')[5];
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
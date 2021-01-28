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
                                <li class="list-inline-item">Setoran Sampah</li>
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
                    <h3 class="title-5">Data Setoran Sampah</h3>
                    <section class="statistic">
                        <div class="section__content section__content--p30">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="statistic__item">
                                            <h2 class="number">{{ number_format($setoran->jumlah,2,",",".") }}Kg</h2>
                                            <span class="desc">Jumlah Setoran</span>
                                            <div class="icon">
                                                <i class="fas fa-leaf" style="height: 190px; width: 190px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="statistic__item">
                                            <h2 class="number">{{ number_format($jumlah->jumlah,2,",",".") }}Kg</h2>
                                            <span class="desc">Sampah Terjual</span>
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="statistic__item">
                                            <h2 class="number">{{ number_format(($setoran->jumlah - $jumlah->jumlah),2,",",".") }}Kg</h2>
                                            <span class="desc">Sampah Tersimpan</span>
                                            <div class="icon">
                                                <i class="fas fa-box" style="height: 190px; width: 190px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="statistic__item">
                                            <h2 class="number">Rp {{ number_format($keuangan->saldo,2,",",".") }}</h2>
                                            <span class="desc">Pendapatan</span>
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2" id="tabelPengurus">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>    
                                    <th>Penanggung Jawab</th>
                                    <th>Jenis Sampah</th>
                                    <th>Harga/kg</th>
                                    <th>Berat</th>
                                    <th>Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjualan as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('D, j F Y',strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->user->nama_lengkap }}</td>
                                    <td>{{ $item->jenis->jenis_sampah }}</td>
                                    <td>Rp {{ number_format($item->jenis->harga,2,",",".") }}</td>
                                    <td>{{ number_format($item->berat,2,",",".") }}kg</td>
                                    <td>Rp {{ number_format($item->debit,2,",",".") }}</td>
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
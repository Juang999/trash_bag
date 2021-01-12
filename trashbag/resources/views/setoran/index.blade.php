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
                    <h3 class="title-5 m-b-35">Data Setoran Sampah</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                <div class="au-card-inner">
                                    <div class="table-responsive">
                                        <table class="table table-top-countries">
                                            <tbody>
                                                @foreach ($jumlah as $item)
                                                <tr>
                                                    <td>{{ $item->jenis_sampah }}</td>
                                                    <td class="text-right">{{ ($item->jumlah == null)?0:$item->jumlah }} kg</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card" width="100%" height="100%">
                                <div class="card-body">
                                  <canvas id="dataChart"></canvas>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2" id="table_id">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nasabah</th>
                                    <th>Keterangan</th>
                                    <th>Jenis Sampah</th>
                                    <th>Harga/kg</th>
                                    <th>Berat</th>
                                    <th>Debit</th>
                                    <th>Penanggung Jawab</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($setoran as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('D, j F Y',strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->user->nama_lengkap }}</td>
                                    <td>
                                        @if ($item->keterangan == 1)
                                            Dijemput
                                        @else
                                            Diantar
                                        @endif
                                    </td>
                                    <td>{{ $item->jenis->jenis_sampah }}</td>
                                    <td>{{ $item->jenis->harga }}</td>
                                    <td>{{ $item->berat }}kg</td>
                                    <td>{{ $item->debit }}</td>
                                    <td>{{ $item->penanggungJawab->nama_lengkap }}</td>
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
            var table = $('#table_id').DataTable();

            var data = @JSON($jumlah);
            var jenis = [] ;
            var jumlah = [];
            var warna = [];
            data.forEach(element => {
                jenis.push(element.jenis_sampah);
                jumlah.push(element.jumlah); 
                warna.push(randomRGB());
                console.log(randomRGB()); 
            });
            
            var ctx = document.getElementById('dataChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: jenis,
                    datasets: [{
                        label: jenis,
                        data: jumlah,
                        backgroundColor: warna
                    }],
                    options: {
                        responsive: true,
                        maintainAspectRatio: true
                    }
                }
            });

            function randomRGB(){
                var red =  Math.floor(Math.random() * 256);
                var green =  Math.floor(Math.random() * 256);
                var blue =  Math.floor(Math.random() * 256);
                return `rgb(${red},${green},${blue})`;
            }
        });
    </script>
@endsection
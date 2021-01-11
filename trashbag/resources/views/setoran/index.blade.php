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
                            <h2 class="title-1 m-b-25">Top countries</h2>
                            <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                <div class="au-card-inner">
                                    <div class="table-responsive">
                                        <table class="table table-top-countries">
                                            <tbody>
                                                <tr>
                                                    <td>United States</td>
                                                    <td class="text-right">$119,366.96</td>
                                                </tr>
                                                <tr>
                                                    <td>Australia</td>
                                                    <td class="text-right">$70,261.65</td>
                                                </tr>
                                                <tr>
                                                    <td>United Kingdom</td>
                                                    <td class="text-right">$46,399.22</td>
                                                </tr>
                                                <tr>
                                                    <td>Turkey</td>
                                                    <td class="text-right">$35,364.90</td>
                                                </tr>
                                                <tr>
                                                    <td>Germany</td>
                                                    <td class="text-right">$20,366.96</td>
                                                </tr>
                                                <tr>
                                                    <td>France</td>
                                                    <td class="text-right">$10,366.96</td>
                                                </tr>
                                                <tr>
                                                    <td>Australia</td>
                                                    <td class="text-right">$5,366.96</td>
                                                </tr>
                                                <tr>
                                                    <td>Italy</td>
                                                    <td class="text-right">$1639.32</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="au-card chart-percent-card">
                                <div class="au-card-inner">
                                    <h3 class="title-2 tm-b-5">char by %</h3>
                                    <div class="row no-gutters">
                                        <div class="col-xl-6">
                                            <div class="chart-note-wrap">
                                                <div class="chart-note mr-0 d-block">
                                                    <span class="dot dot--blue"></span>
                                                    <span>products</span>
                                                </div>
                                                <div class="chart-note mr-0 d-block">
                                                    <span class="dot dot--red"></span>
                                                    <span>services</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="percent-chart">
                                                <canvas id="percent-chart"></canvas>
                                            </div>
                                        </div>
                                    </div>
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
        });
    </script>
@endsection
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
                                <li class="list-inline-item">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- STATISTIC-->
<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ number_format($nasabah->jumlah, 0,"",".") }}</h2>
                                    <span>Nasabah</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-trash"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ number_format($setoran->jumlah, 2, ",", ".") }} Kg</h2>
                                    <span>Total Setoran</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ number_format($penjualan->jumlah,2,",",".") }} Kg</h2>
                                    <span>Sampah Terjual</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ number_format($setoran->jumlah - $penjualan->jumlah,2,',','.') }} Kg</h2>
                                    <span>Sampah Tersimpan</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                                <div class="text">
                                    <h2>Rp {{ number_format($keuangan->saldo,0,"",".") }}</h2>
                                    <span>Total Saldo</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->

@endsection

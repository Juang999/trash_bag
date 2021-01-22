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
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Detail Data Nasabah</li>
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
                <div class="table-data__tool-left">
                    
                </div>
                <div class="table-data__tool-right">
                    <button type="button" class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#exampleModal">
                        Penarikan
                    </button>
                </div>
            </div>
            <div class="row m-t-3">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40" style="overflow-y: scroll; max-height:350px">
                        <table class="table table-borderless table-data3">
                            <thead style="position: sticky; top:0;">
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Jenis Sampah</th>
                                    <th>Berat/kg</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buku as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('D, j F Y',strtotime($item->created_at)) }}</td>
                                    <td>
                                        @if (is_null($item->keterangan))
                                            -
                                        @elseif($item->keterangan == 1)
                                            Dijemput
                                        @else
                                            Diantar
                                        @endif
                                    </td>
                                    <td>
                                        @if (is_null($item->jenis_id))
                                            -
                                        @else
                                            {{ $item->jenis->jenis_sampah}}
                                        @endif
                                    </td>
                                    <td>{{$item->berat}}</td>
                                    <td>{{ (is_null($item->debit))?'-':$item->debit }}</td>
                                    <td>{{ (is_null($item->kredit))?'-':$item->kredit }}</td>
                                    <td>{{ $item->saldo }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Penarikan Uang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4>Jumlah Saldo : {{ $saldo->saldo }}</h4>
            <form action="{{ url('nasabah/penarikan/'.$saldo->user_id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nominal">Nominal Penarikan</label>
                    <input type="text" class="form-control" name="nominal" id="nominal" placeholder="">
                    <small id="nominal" class="text-muted">
                        Penarikan tidak bisa lebih dari jumlah saldo
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

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
                                <li class="list-inline-item">Jenis Sampah</li>
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
                    <h3 class="title-5 m-b-35">Data Jenis Sampah</h3>
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
                            <button type="button" class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#modalInput">
                                <i class="zmdi zmdi-plus"></i>add user</button>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2" id="table_id">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Sampah</th>
                                    <th>Harga/kg</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($jenisSampah as $key => $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->jenis_sampah }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item btnEdit" type="button" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modalEdit">
                                                    <span  data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </span>
                                                </button>
                                                <a href="{{ url('jenis/delete/'.$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
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

<div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="modalInputLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInputLabel">Tambah Data Jenis Sampah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('jenis') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="jenis_sampah" class=" form-control-label">Jenis Sampah</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="jenis_sampah" name="jenis_sampah" placeholder="Jenis Sampah" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="harga" class=" form-control-label">Harga</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="harga" name="harga" placeholder="Harga" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Data Jenis Sampah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal" id="formEdit">
                    @csrf
                    @method('put')
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="jenis_sampah" class=" form-control-label">Jenis Sampah</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="jenis_sampah" name="jenis_sampah" placeholder="Jenis Sampah" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="harga" class=" form-control-label">Harga</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="harga" name="harga" placeholder="Harga" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var table = $('#table_id').DataTable();
            
            $('.btnEdit').on('click', function(){
                const id = $(this).data('id');
                $('#formEdit').attr('action', 'jenis/'+id);
                $.ajax({
                        url:'jenis/getEdit/'+id,
                        method: 'get', 
                        dataType: 'json',
                        success:function(data){
                            console.log(data);
                            $('#formEdit #jenis_sampah').val(data.jenis_sampah);
                            $('#formEdit #harga').val(data.harga);
                        }
                    });
            });
        });


    </script>
@endsection
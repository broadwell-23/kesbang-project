@extends('layouts.layouts')

@push('css')
<link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
<link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
<link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
           <header class="panel-heading">
              <i class="fa fa-database"></i> Data Tokoh Agama
            </header>
            <div class="panel-body">
              <div class="container-fluid">
              <div class="pull-left">
              </div>
                <div class="pull-right">
                  <button class="btn btn-success" data-toggle="modal" href="#modalTambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="adv-table">
                  <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table-striped table-advance table-hover" id="toga">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Tokoh Masyarakat</th>
                          <th>Nama Kecamatan</th>
                          <th>No. Handphone</th>
                          <th>Alamat</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($togas as $no => $toga)
                      <tr>
                        <td>{{$no+1}}</td>
                        <td>
                          <p>{{$toga->nama}}</p>
                          <p>
                            <button class="btn btn-xs btn-primary" data-toggle="modal" href="#modalUbah{{$toga->id}}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" href="#modalHapus{{$toga->id}}"><i class="fa fa-trash"></i></button>
                          </p>
                        </td>
                        <td>{{$toga->kecamatan->nama}}</td>
                        <td>{{$toga->no_hp}}</td>
                        <td>{{$toga->alamat}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
        </section>
    </div>
</div>

<!-- MODAL COLLECTIONS -->

  <!-- Modal Tambah -->
  <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header" style="background-color: green;">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Tambah Tokoh Masyarakat</h4>
              </div>
              <div class="modal-body">

                <form method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">
                  <label class="control-label">Nama Kecamatan</label>
                    <select class="form-control" name="id_kecamatan" required="">
                      @foreach($kecamatans as $kecamatan)
                        <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">No. handphone</label>
                    <input type="number" name="no_hp" class="form-control" min="0" value="08" maxlength="12" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required=""></textarea>
                  </div>

                  <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Tambah <i class="fa fa-chevron-right"></i></button>
                  </div>

                </form>

              </div>
          </div>
      </div>
  </div>
  <!-- END modal tambah-->

  @foreach($togas as $toga)
    <!-- Modal ubah -->
    <div class="modal fade" id="modalUbah{{$toga->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Data Tokohh Masyarakat</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{$toga->id}}">

                    <div class="form-group">
                      <label class="control-label">Nama Kecamatan</label>
                      <select class="form-control" name="id_kecamatan">
                      @foreach($kecamatans as $kecamatan)
                        @if($toga->kecamatan->id==$kecamatan->id)
                          <option value="{{$kecamatan->id}}" selected="">{{$kecamatan->nama}}</option>
                          @else
                          <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                        @endif
                      @endforeach
                      </select>
                    </div>
                  <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{$toga->nama}}" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">No. handphone</label>
                    <input type="number" name="no_hp" class="form-control" min="0" maxlength="12" value="{{$toga->no_hp}}" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required="">{{$toga->alamat}}</textarea>
                  </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ubah <i class="fa fa-chevron-right"></i></button>
                    </div>

                  </form>

                </div>
            </div>
        </div>
    </div>
    <!-- END modal ubah-->

    <!-- Modal hapus -->
    <div class="modal fade" id="modalHapus{{$toga->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: red;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus Data Tokoh Masyarakat</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{$toga->id}}">

                    <center>
                      <p>Apakah anda yakin akan menghapus data Tokoh masyarakat berikut</p>
                      <p><strong>Nama : {{$toga->nama}}</strong></p>
                      <p><strong>Kecamatan : {{$toga->kecamatan->nama}}</strong> ?</p>
                    </center>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus <i class="fa fa-chevron-right"></i></button>
                    </div>

                  </form>

                </div>
            </div>
        </div>
    </div>
    <!-- END modal hapus-->
  @endforeach

<!-- MODAL COLLECTIONS -->

@endsection

@push('js')

<!-- js placed at the end of the document so the pages load faster -->
<!--<script src="js/jquery.js"></script>-->
<script type="text/javascript" language="javascript" src="/admin/assets/advanced-datatable/media/js/jquery.js"></script>
<script src="/admin/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="/admin/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/admin/js/jquery.scrollTo.min.js"></script>
<script src="/admin/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="/admin/js/respond.min.js" ></script>
<script type="text/javascript" language="javascript" src="/admin/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="/admin/assets/data-tables/DT_bootstrap.js"></script>

<!--common script for all pages-->
<script src="js/common-scripts.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#toga').dataTable();
  });
</script>
@endpush
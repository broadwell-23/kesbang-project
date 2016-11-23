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
              <i class="fa fa-database"></i> Data agama
            </header>
            <div class="panel-body">
              <div class="container-fluid">
              <div class="pull-left">
                @if($_GET['success']==1)
                  <div class="alert alert-block alert-danger fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Data Sudah Ada!</strong> Pilih Kecamatan Lain atau Ubah Data Kecamatan tersebut.
                  </div>
                @endif
              </div>
                <div class="pull-right">
                  <button class="btn btn-success" data-toggle="modal" href="#modalTambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="adv-table">
                  <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table-striped table-advance table-hover" id="agama">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Kecamatan</th>
                          <th>Islam</th>
                          <th>Katolik</th>
                          <th>Kristen Protestan</th>
                          <th>Hindu</th>
                          <th>Budha</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($agamas as $no => $agama)
                      <tr>
                        <td>{{$no+1}}</td>
                        <td>
                          <p>{{$agama->kecamatan->nama}}</p>
                          <p>
                            <button class="btn btn-xs btn-primary" data-toggle="modal" href="#modalUbah{{$agama->id_kecamatan}}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" href="#modalHapus{{$agama->id_kecamatan}}"><i class="fa fa-trash"></i></button>
                          </p>
                        </td>
                        <td>{{$agama->islam}}</td>
                        <td>{{$agama->katolik}}</td>
                        <td>{{$agama->kristen}}</td>
                        <td>{{$agama->hindu}}</td>
                        <td>{{$agama->budha}}</td>
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
                  <h4 class="modal-title">Tambah agama</h4>
              </div>
              <div class="modal-body">

                <form method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">
                  <label class="control-label">Nama Kecamatan</label>
                    <select class="form-control" name="id_kecamatan">
                      @foreach($kecamatans as $kecamatan)
                        <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Islam</label>
                    <input type="number" name="islam" class="form-control" min="0" value="0">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Katolik</label>
                    <input type="number" name="katolik" class="form-control" min="0" value="0">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Kristen Protestan</label>
                    <input type="number" name="kristen" class="form-control" min="0" value="0">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Hindu</label>
                    <input type="number" name="hindu" class="form-control" min="0" value="0">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Budha</label>
                    <input type="number" name="budha" class="form-control" min="0" value="0">
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

  @foreach($agamas as $agama)
    <!-- Modal ubah -->
    <div class="modal fade" id="modalUbah{{$agama->id_kecamatan}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Agama</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{$agama->id_kecamatan}}">

                    <div class="form-group">
                      <label class="control-label">Nama Kecamatan</label>
                      <select class="form-control" name="id_kecamatan">
                      @foreach($kecamatans as $kecamatan)
                        @if($agama->kecamatan->id==$kecamatan->id)
                          <option value="{{$kecamatan->id}}" selected="">{{$kecamatan->nama}}</option>
                          @else
                          <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                        @endif
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                    <label class="control-label">Islam</label>
                    <input type="number" name="islam" class="form-control" min="0" value="{{$agama->islam}}">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Katolik</label>
                    <input type="number" name="katolik" class="form-control" min="0" value="{{$agama->katolik}}">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Kristen Protestan</label>
                    <input type="number" name="kristen" class="form-control" min="0" value="{{$agama->kristen}}">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Hindu</label>
                    <input type="number" name="hindu" class="form-control" min="0" value="{{$agama->hindu}}">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Budha</label>
                    <input type="number" name="budha" class="form-control" min="0" value="{{$agama->protestan}}">
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
    <div class="modal fade" id="modalHapus{{$agama->id_kecamatan}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: red;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus Agama</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{$agama->id_kecamatan}}">

                    <center>
                      <p>Apakah anda yakin akan menghapus data agama Kecamatan</p>
                      <p><strong>{{$agama->kecamatan->nama}}</strong> ?</p>
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
    $('#agama').dataTable();
  });
</script>
@endpush
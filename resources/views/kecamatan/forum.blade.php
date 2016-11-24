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
              <i class="fa fa-database"></i> Data Forum
            </header>
            <div class="panel-body">
              <div class="container-fluid">
              <div class="pull-left">
              </div>
                <div class="pull-right">
                  <button class="btn btn-success" data-toggle="modal" href="#modalTambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="adv-table">
                  <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table-striped table-advance table-hover" id="forum" style="text-align: center;">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Tahun Daftar</th>
                          <th>Nama Kecamatan</th>
                          <th>Laporan</th>
                          <th>Alamat</th>
                          <th>Tipe</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($forums as $no => $forum)
                      <tr>
                        <td>{{$no+1}}</td>
                        <td>
                          <p>{{$forum->nama}}</p>
                          <p>
                            <button class="btn btn-xs btn-primary" data-toggle="modal" href="#modalUbah{{$forum->id}}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" href="#modalHapus{{$forum->id}}"><i class="fa fa-trash"></i></button>
                            <a href="/admin/pengurus-forum/{{$forum->id}}"><button class="btn btn-xs btn-success"><i class="fa fa-info"></i> Pengurus</button></a>
                          </p>
                        </td>
                        <td>{{$forum->tahun_daftar}}</td>
                        <td>{{$forum->kecamatan->nama}}</td>
                        <td>{{$forum->laporan}}</td>
                        <td>{{$forum->alamat}}</td>
                        <td style="text-align: center;">
                          @if($forum->tipe==0)
                              <span class="label label-warning">Forum</span>
                          @else
                              <span class="label label-primary">LSM (Lembaga Swadaya Masyarakat)</span>
                          @endif
                        </td>
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
                  <h4 class="modal-title">Tambah Forum</h4>
              </div>
              <div class="modal-body">

                <form method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">
                    <label class="control-label">Tipe</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipe" value="0" checked>
                            Forum
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipe" value="1">
                            LSM ( Lembaga Swadaya Masyarakat)
                        </label>
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input type="text" name="nama" class="form-control" maxlength="255">
                  </div>
                  <div class="form-group">
                  <label class="control-label">Nama Kecamatan</label>
                    <select class="form-control" name="id_kecamatan">
                      @foreach($kecamatans as $kecamatan)
                        <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Tahun Daftar</label>
                    <input type="date" name="tahun_daftar" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Laporan</label>
                    <input type="text" name="laporan" class="form-control" maxlength="255">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5"></textarea>
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

  @foreach($forums as $forum)
    <!-- Modal ubah -->
    <div class="modal fade" id="modalUbah{{$forum->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Forum</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{$forum->id}}">

                    <div class="form-group">
                    <label class="control-label">Tipe</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipe" value="0" @if($forum->tipe==0) checked @endif >
                            Forum
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipe" value="1" @if($forum->tipe==1) checked @endif >
                            LSM ( Lembaga Swadaya Masyarakat)
                        </label>
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input type="text" name="nama" class="form-control" maxlength="255" value="{{$forum->nama}}">
                  </div>
                  <div class="form-group">
                  <label class="control-label">Nama Kecamatan</label>
                    <select class="form-control" name="id_kecamatan">
                      @foreach($kecamatans as $kecamatan)
                        @if($forum->kecamatan->id==$kecamatan->id)
                          <option value="{{$kecamatan->id}}" selected="">{{$kecamatan->nama}}</option>
                          @else
                          <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Tahun Daftar</label>
                    <input type="date" name="tahun_daftar" class="form-control" value="{{$forum->tahun_daftar}}">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Laporan</label>
                    <input type="text" name="laporan" class="form-control" maxlength="255" value="{{$forum->laporan}}">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5">{{$forum->alamat}}</textarea>
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
    <div class="modal fade" id="modalHapus{{$forum->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: red;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus Forum</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{$forum->id}}">

                    <center>
                      <p>Apakah anda yakin akan menghapus data Forum</p>
                      <p><strong>Nama : {{$forum->nama}}</strong></p>
                      <p><strong>Kecamatan : {{$forum->kecamatan->nama}}</strong> ?</p>
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
    $('#forum').dataTable();
  });
</script>
@endpush
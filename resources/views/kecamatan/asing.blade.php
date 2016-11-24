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
              <i class="fa fa-database"></i> Data Orang Asing
            </header>
            <div class="panel-body">
              <div class="container-fluid">
              <div class="pull-left">
              </div>
                <div class="pull-right">
                  <button class="btn btn-success" data-toggle="modal" href="#modalTambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="adv-table">
                  <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table-striped table-advance table-hover" id="asing">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Kecamatan</th>
                          <th>Nama Orang Asing</th>
                          <th>Jenis Kelamin</th>
                          <th>Tempat</th>
                          <th>Tanggal Lahir</th>
                          <th>Kebangsaan</th>
                          <th>No. Paspor</th>
                          <th>Masa Paspor</th>
                          <th>No. Kitas</th>
                          <th>Masa Kitas</th>
                          <th>Sponsor</th>
                          <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($asings as $no => $asing)
                      <tr>
                        <td>{{$no+1}}</td>
                        <td>
                          <p>{{$asing->kecamatan->nama}}</p>
                          <p>
                            <button class="btn btn-xs btn-primary" data-toggle="modal" href="#modalUbah{{$asing->id_kecamatan}}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" href="#modalHapus{{$asing->id_kecamatan}}"><i class="fa fa-trash"></i></button>
                          </p>
                        </td>
                        <td>{{$asing->nama}}</td>
                        <td style="text-align: center;">
                          @if($asing->jk==0)
                              <span class="label label-warning">Perempuan</span>
                          @else
                              <span class="label label-primary">Laki-laki</span>
                          @endif
                        </td>
                        <td>{{$asing->tempat}}</td>
                        <td>{{$asing->tl}}</td>
                        <td>{{$asing->kebangsaan}}</td>
                        <td>{{$asing->no_paspor}}</td>
                        <td>{{$asing->masa_paspor}}</td>
                        <td>{{$asing->no_kitas}}</td>
                        <td>{{$asing->masa_kitas}}</td>
                        <td>{{$asing->sponsor}}</td>
                        <td>{{$asing->keterangan}}</td>
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
                  <h4 class="modal-title">Tambah Asing</h4>
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
                    <label class="control-label">Nama Orang Asing</label>
                    <input type="text" name="nama" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Jenis Kelamin</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="jk" value="0">
                            Perempuan
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="jk" value="1" checked="">
                            Laki-laki
                        </label>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label class="control-label">Tempat Lahir</label>
                    <input type="text" name="tempat" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Tanggal Lahir</label>
                    <input type="date" name="tl" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Kebangsaan</label>
                    <input type="text" name="kebangsaan" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">No. Paspor</label>
                    <input type="text" name="no_paspor" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Masa Paspor</label>
                    <input type="date" name="masa_paspor" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">No. Kartu Identitas</label>
                    <input type="text" name="no_kitas" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Masa Kartu Identitas</label>
                    <input type="date" name="masa_kitas" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Sponsor</label>
                    <input type="text" name="sponsor" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
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

  @foreach($asings as $asing)
    <!-- Modal ubah -->
    <div class="modal fade" id="modalUbah{{$asing->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah asing</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{$asing->id}}">

                    <div class="form-group">
                      <label class="control-label">Nama Kecamatan</label>
                      <select class="form-control" name="id_kecamatan">
                      @foreach($kecamatans as $kecamatan)
                        @if($asing->kecamatan->id==$kecamatan->id)
                          <option value="{{$kecamatan->id}}" selected="">{{$kecamatan->nama}}</option>
                          @else
                          <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                        @endif
                      @endforeach
                      </select>
                    </div>
                   <div class="form-group">
                    <label class="control-label">Nama Orang Asing</label>
                    <input type="text" name="nama" class="form-control" value="{{$asing->nama}}" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Jenis Kelamin</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="jk" value="0" @if($asing->jk=0) checked @endif>
                            Perempuan
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="jk" value="1" @if($asing->jk=1) checked @endif>
                            Laki-laki
                        </label>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label class="control-label">Tempat Lahir</label>
                    <input type="text" name="tempat" class="form-control" value="{{$asing->tempat}}" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Tanggal Lahir</label>
                    <input type="date" name="tl" class="form-control" value="{{$asing->tl}}" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Kebangsaan</label>
                    <input type="text" name="kebangsaan" class="form-control" value="{{$asing->kebangsaan}}" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">No. Paspor</label>
                    <input type="text" name="kebangsaan" class="form-control" value="{{$asing->no_paspor}}" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Masa Paspor</label>
                    <input type="date" name="masa_paspor" class="form-control" value="{{$asing->masa_paspor}}" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">No. Kartu Identitas</label>
                    <input type="text" name="no_kitas" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Masa Kartu Identitas</label>
                    <input type="date" name="masa_kitas" class="form-control" value="{{$asing->masa_kitas}}" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Sponsor</label>
                    <input type="text" name="sponsor" class="form-control" value="{{$asing->sponsor}}" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control">{{$asing->keterangan}}</textarea>
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
    <div class="modal fade" id="modalHapus{{$asing->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: red;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus asing</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{$asing->id}}">

                    <center>
                      <p>Apakah anda yakin akan menghapus Data Orang Asing dengan Nama : </p>
                      <p><strong>{{$asing->nama}}</strong> ?</p>
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
    $('#asing').dataTable();
  });
</script>
@endpush
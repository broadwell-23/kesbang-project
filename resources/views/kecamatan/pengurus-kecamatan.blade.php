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
              <i class="fa fa-database"></i> Data Pengurus Kecamatan <strong style="color: red;">{{$nama_kecamatan}}</strong>
            </header>
            <div class="panel-body">
              <div class="container-fluid">
              <div class="pull-left">
              </div>
                <div class="pull-right">
                  <button class="btn btn-success" data-toggle="modal" href="#modalTambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="adv-table">
                  <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table-striped table-advance table-hover" id="pengurus" style="text-align: center;">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Foto</th>
                          <th>Nama Lengkap</th>
                          <th>Jabatan</th>
                          <th>NIP</th>
                          <th>Alamat</th>
                          <th>No. Handphone</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($penguruss as $no => $pengurus)
                      <tr>
                        <td>{{$no+1}}</td>
                        <td>
                          @if($pengurus->foto!="")
                            <img class="img img-responsive" src="{{$pengurus->foto}}" height="120px" width="65px">
                            @else
                            <img class="img img-responsive" src="/admin/img/noprofile.jpg" height="120px" width="65px">
                          @endif
                        </td>
                        <td>
                          <p>{{$pengurus->nama}}</p>
                          <p>
                            <button class="btn btn-xs btn-primary" data-toggle="modal" href="#modalUbah{{$pengurus->id}}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" href="#modalHapus{{$pengurus->id}}"><i class="fa fa-trash"></i></button>
                          </p>
                        </td>
                        <td>{{$pengurus->jabatan}}</td>
                        <td>{{$pengurus->nip}}</td>
                        <td>{{$pengurus->alamat}}</td>
                        <td>{{$pengurus->no_hp}}</td>
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
                  <h4 class="modal-title">Tambah Pengurus Kecamatan {{$nama_kecamatan}}</h4>
              </div>
              <div class="modal-body">

                <form method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id_kecamatan" value="{{$id}}">

                  <div class="form-group">
                    <label class="control-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">NIP</label>
                    <input type="text" name="nip" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required=""></textarea>
                  </div>
                  <div class="form-group">
                    <label class="control-label">No. handphone</label>
                    <input type="number" name="no_hp" class="form-control" min="0" value="08" maxlength="12" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Foto</label>
                        <div class="input-group">
                          <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-warning">
                              <i class="fa fa-picture-o"></i> Pilih
                            </a>
                          </span>
                          <input id="thumbnail" class="form-control" type="text" name="foto" value="">
                        </div>
                        <div class="container-fluid">
                          <center><img id="holder" style="margin-top:15px;max-height:100px;" src=""></center>
                        </div>
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

  @foreach($penguruss as $pengurus)
    <!-- Modal ubah -->
    <div class="modal fade" id="modalUbah{{$pengurus->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Data Pengurus Kecamatan {{$nama_kecamatan}}</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{$pengurus->id}}">
                    <input type="hidden" name="id_kecamatan" value="{{$id}}">

                  <div class="form-group">
                    <label class="control-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{$pengurus->nama}}" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="{{$pengurus->jabatan}}" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{$pengurus->nip}}" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required="">{{$pengurus->alamat}}</textarea>
                  </div>
                  <div class="form-group">
                    <label class="control-label">No. handphone</label>
                    <input type="number" name="no_hp" class="form-control" min="0" value="{{$pengurus->no_hp}}" maxlength="12" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Foto</label>
                        <div class="input-group">
                          <span class="input-group-btn">
                            <a id="lfm{{$pengurus->id}}" data-input="thumbnail{{$pengurus->id}}" data-preview="holder{{$pengurus->id}}" class="btn btn-warning">
                              <i class="fa fa-picture-o"></i> Pilih
                            </a>
                          </span>
                          <input id="thumbnail{{$pengurus->id}}" class="form-control" type="text" name="foto" value="{{$pengurus->foto}}">
                        </div>
                        <div class="container-fluid">
                          <center><img id="holder{{$pengurus->id}}" style="margin-top:15px;max-height:100px;" src="{{$pengurus->foto}}"></center>
                        </div>
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
    <div class="modal fade" id="modalHapus{{$pengurus->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: red;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus Data {{$nama_kecamatan}}</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{$pengurus->id}}">

                    <center>
                      <p>Apakah anda yakin akan menghapus data Toko masyarakat berikut</p>
                      <p><strong>Nama : {{$pengurus->nama}}</strong></p>
                      <p><strong>Kecamatan : {{$pengurus->kecamatan->nama}}</strong> ?</p>
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
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#lfm').filemanager('image');
    @foreach($penguruss as $pengurus)
      $('#lfm{{$pengurus->id}}').filemanager('image');
    @endforeach
    $('#pengurus').dataTable();
  });
</script>
@endpush
@extends('layouts.layouts')

@push('css')
<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <link href="assets/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/>
    <link href="css/image-crop.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
           <header class="panel-heading">
                Slider Management
            </header>
            <div class="panel-body">
              <div class="container-fluid">
                  <div class="container-fluid">
                  <span class="pull-right">
                    <button class="btn btn-success" data-toggle="modal" href="#modalTambah" >
                      <span class="fa fa-plus-circle"></span> Tambah Data
                    </button>
                  </span>
              </div>
              </div>
              <div class="adv-table">
                <table class="display table table-bordered table-striped" id="example">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($sliders as $no => $slider)
                    <tr>
                        <td>{{ $no+1 }}</td>
                        <td>{{ $slider->judul }}</td>
                        <td>{{ $slider->deskripsi }}</td>
                        <td>
                          <a data-toggle="modal" href="#modalImage{{ $slider->id }}">
                            <img src="/img/sliders/{{ $slider->foto }}" alt="Preview" style="height:25px" />
                          </a>
                        </td>
                        <td>
                            <center>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" href="#modalUbah{{ $slider->id }}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" href="#modalHapus{{ $slider->id }}"><i class="fa fa-trash-o "></i></button>
                            </center>
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
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Tambah Slide</h4>
              </div>
              <div class="modal-body">

                <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ url('admin/slider') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Judul*</label>
                        <div class="col-sm-10">
                          <input name="judul" type="text" placeholder="" class="form-control" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deskripsi*</label>
                        <div class="col-sm-10">
                            <input name="deskripsi" type="text" placeholder="" class="form-control" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-10">
                            <input name="foto" accept="image/*" type="file" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>

                </form>

              </div>
          </div>
      </div>
  </div>
  <!-- END modal tambah-->

  @foreach($sliders as $no => $slider)
  <!-- Modal Tampil Image -->
    <div class="modal fade" id="modalImage{{ $slider->id }}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm" style="top:150px;">
        <div class="row">
            <div class="col-md-12">
                <center>
                <img src="/img/sliders/{{ $slider->foto }}" style="width:100%;">
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h4 style="color:white;">{{ $slider->judul }}</h4>
                </center>
            </div>
        </div>
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal tampil image-->

  <!-- Modal update -->
  <div class="modal fade" id="modalUbah{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Ubah Slide</h4>
              </div>
              <div class="modal-body">

                <form enctype="multipart/form-data" action="{{ url('admin/slider') }}" class="form-horizontal" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $slider->id }}">

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Judul*</label>
                        <div class="col-sm-10">
                          <input name="judul" type="text" placeholder="" class="form-control" required="" value="{{ $slider->judul }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deskripsi*</label>
                        <div class="col-sm-10">
                            <input name="deskripsi" type="text" placeholder="" class="form-control" required="" value="{{ $slider->deskripsi }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-10">
                            <input name="foto" accept="image/*" type="file" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Ubah</button>
                    </div>

                </form>

              </div>
          </div>
      </div>
  </div>
  <!-- END modal update-->

  <!-- Modal Hapus -->
    <div class="modal fade" id="modalHapus{{ $slider->id }}" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header alert alert-danger">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Warning!</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/slider') }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $slider->id }}">

                <center>
                    <p>Apakah anda yakin ingin menghapus foto <b>{{ $slider->judul }}</b>?</p>
                </center>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
                </div>
            </form>
          </div>
          
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /END modal Hapus -->
  @endforeach
<!-- END MODAL COLLECTIONS -->
@endsection

@push('js')
<!-- js placed at the end of the document so the pages load faster -->
    <!--<script src="js/jquery.js"></script>-->
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script src="js/respond.min.js" ></script>
    <script src="assets/jcrop/js/jquery.color.js"></script>
    <script src="assets/jcrop/js/jquery.Jcrop.min.js"></script>


  <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--script for this page only-->

      <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );
          } );
      </script>

  <script src="js/common-scripts.js"></script>

  <script src="js/form-image-crop.js"></script>
  <script>
      jQuery(document).ready(function() {
          // initiate layout and plugins
          FormImageCrop.init();
      });
  </script>
@endpush
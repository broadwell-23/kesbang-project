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
              <i class="fa fa-clone"></i>	Halaman
          	</header>
          	<div class="panel-body">
              <div class="container-fluid">
                <div class="pull-right">
                  <a href="new-page"><button class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button></a>
                </div>
                <div class="adv-table">
                  <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table-striped table-advance table-hover" id="halaman">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Judul</th>
                          <th>Deskripsi</th>
                          <th>Author</th>
                          <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pages as $no => $page)
                      <tr>
                        <td>{{$no+1}}</td>
                        <td><p>{{substr($page->judul, 0,50)}}</p><p><button class="btn btn-xs btn-danger" data-toggle="modal" href="#modalHapus{{$page->id}}"><i class="fa fa-trash"></i></button> <a href="edit-page/{{$page->id}}"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a></p></td>
                        <td>{{rtrim(strip_tags(substr($page->deskripsi, 0,100)),"\r\n")}}</td>
                        <td>{{$page->user->name}}</td>
                        <td><p>
                        @if($page->status==0)
                          <strong style="color: red;">Draft</strong>
                        @else
                          <strong style="color: green;">Terkirim</strong>
                        @endif
                        </p><p>{{$page->created_at}}</p></td>
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

  @foreach($pages as $page)

    <!-- Modal hapus -->
    <div class="modal fade" id="modalHapus{{$page->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: red;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus Kategori</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{$page->id}}">

                    <center>
                      <p>Apakah anda yakin akan menghapus Halaman</p>
                      <p><strong>{{$page->judul}}</strong> ?</p>
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
    $('#halaman').dataTable();
  });
</script>
@endpush
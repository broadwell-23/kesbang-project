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
              <i class="fa fa-list"></i>	Menu
          	</header>
          	<div class="panel-body">
              <div class="container-fluid">
                <div class="pull-right">
                  <button class="btn btn-success" data-toggle="modal" href="#modalTambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="adv-table">
                  <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table-striped table-advance table-hover" id="navbar">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Text</th>
                          <th>Link</th>
                          <th>Parent</th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($navbars as $no => $navbar)
                      <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$navbar->text}}</td>
                        <td>{{$navbar->link}}</td>
                        <td>{{$navbar->parent}}</td>
                        <td>
                          <button class="btn btn-xs btn-primary" data-toggle="modal" href="#modalUbah{{$navbar->id}}"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-xs btn-danger" data-toggle="modal" href="#modalHapus{{$navbar->id}}"><i class="fa fa-trash"></i></button>
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
                  <h4 class="modal-title">Tambah Menu</h4>
              </div>
              <div class="modal-body">

                <form method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">
                    <label class="control-label">Text</label>
                    <input type="text" name="text" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Tipe</label>
                    <select id="tipes" class="form-control" onchange="tipe()">
                      <option value="0" selected="">Link</option>
                      <option value="1">Halaman</option>
                      <option value="2">Kategori</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div id="form">
                      <div id="link">
                        <label class="control-label">Link</label>
                        <input type="url" name="link" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Parent</label>
                    @if(!$navbars->isEmpty())
                      <select class="form-control" name="parent">
                        <option value="" selected=""></option>
                        @foreach($navbars as $navbar)
                          <option value="{{$navbar->id}}">{{$navbar->text}}</option>
                        @endforeach
                      </select>
                    @else
                      <div class="container-fluid" style="border: 2px solid;border-radius: 25px; padding:5px;color:red;"><center><strong>Menu Kosong</strong></center></div>
                      <input type="hidden" name="parent" value="">
                    @endif
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

  @foreach($navbars as $navbar)
    <!-- Modal ubah -->
    <div class="modal fade" id="modalUbah{{$navbar->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Menu</h4>
                </div>
                <div class="modal-body">

                  <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{$navbar->id}}">

                    <div class="form-group">
                      <label class="control-label">Text</label>
                      <input type="text" name="text" class="form-control" value="{{$navbar->nama}}">
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
    <div class="modal fade" id="modalHapus{{$navbar->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="id" value="{{$navbar->id}}">

                    <center>
                      <p>Apakah anda yakin akan menghapus Menu</p>
                      <p><strong>{{$navbar->text}}</strong> ?</p>
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
    $('#navbar').dataTable();
  });
</script>

<script type="text/javascript">
  function tipe() {
      var value = $('#tipes').val();
      console.log(value);
    if (value==0) {
         $('#form').empty();
         document.getElementById("form").innerHTML =  '<div id="link">'+
                                                        '<label class="control-label">Link</label>'+
                                                        '<input type="url" name="link" class="form-control" required>'+
                                                      '</div>';
    } else if (value==1) {
         $('#form').empty();
         $.ajax({

              type:"GET",
              url:'/admin/page-data',
              dataType: 'json',
              success: function(data){
                  // console.log(data);
                  var arrayPage= data;
                  var page = '<div id="link">'+
                                    '<label class="control-label">Halaman</label>'+
                                    '<select name="link" class="form-control">';
                  for(i=0;i<arrayPage.length;i++){
                    if(i==0){
                     page += '<option value="http://localhost:8000/page/'+arrayPage[i]["id"]+'" selected/>'+arrayPage[i]["judul"]+'</option> ';
                    } else {
                     page += '<option value="http://localhost:8000/page/'+arrayPage[i]["id"]+'"/>'+arrayPage[i]["judul"]+'</option> ';
                    }
                  }
                  page += '</select></div>';
                  // console.log(page);
                  if (page=='<div id="link"><label class="control-label">Halaman</label><select name="link" class="form-control"></select></div>') {
                  document.getElementById("form").innerHTML = '<div class="container-fluid" style="border: 2px solid;border-radius: 25px; padding:5px;color:red;"><center><strong>Halaman Kosong</strong></center></div>';
                  } else {
                  document.getElementById("form").innerHTML = page;
                  }
              },
              error: function(e) {
                console.log("error");
              }
            });
    } else {
         $('#form').empty();
         $.ajax({

              type:"GET",
              url:'/admin/category-data',
              dataType: 'json',
              success: function(data){
                  // console.log(data);
                  var arrayCategory= data;
                  var category = '<div id="link">'+
                                    '<label class="control-label">Kategori</label>'+
                                    '<select name="link" class="form-control">';
                  for(i=0;i<arrayCategory.length;i++){
                    if(i==0){
                     category += '<option value="http://localhost:8000/kategori/'+arrayCategory[i]["id"]+'" selected/>'+arrayCategory[i]["nama"]+'</option> ';
                    } else {
                     category += '<option value="http://localhost:8000/kategori/'+arrayCategory[i]["id"]+'"/>'+arrayCategory[i]["nama"]+'</option> ';
                    }
                  }
                  category += '</select></div>';
                  // console.log(category);
                  if (category=='<div id="link"><label class="control-label">Kategori</label><select name="link" class="form-control"></select></div>') {
                  document.getElementById("form").innerHTML = '<div class="container-fluid" style="border: 2px solid;border-radius: 25px; padding:5px;color:red;"><center><strong>Kategori Kosong</strong></center></div>';
                  } else {
                  document.getElementById("form").innerHTML = category;
                  }
              },
              error: function(e) {
                console.log("error");
              }
          });                                                        
    }
  }
</script>
@endpush
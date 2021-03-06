@extends('layouts.layouts')

@push('css')
<link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-colorpicker/css/colorpicker.css" />
<link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-daterangepicker/daterangepicker.css" />
<link href="/admin/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
<link href="/admin/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="/admin/assets/data-tables/DT_bootstrap.css" />
<!-- Custom styles for this template -->
<link href="/admin/css/style.css" rel="stylesheet">
<link href="/admin/css/style-responsive.css" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
  	<div class="col-lg-8">
      	<section class="panel">
         	 <header class="panel-heading">
              <i class="fa fa-thumb-tack"></i>	{{$judul}} Postingan/Artikel
          	</header>
          	<div class="panel-body">
              <div class="container-fluid">
                  <form id="article" method="POST" onsubmit="return check(this)" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="author" value="{{Auth::user()->id}}">
                    @if($id!=null)
                    <input type="hidden" name="id" value="{{$id}}">
                    @endif
                    <div class="form-group">
                      <label>Judul Artikel</label>
                      <input id="judul" type="text" name="judul" class="form-control" maxlength="255" value="@if($id!=null){{$posts->judul}}@endif">
                      <div id="hintjudul"></div>
                    </div>
                     <div class="form-group">
                          <button type="button" class="btn btn-xs btn-success" data-toggle="modal" href="#modalTambah"><i class="fa fa-plus"></i></button>
                          <label>Kategori</label>
                          <div id="category" style="margin-top: 10px;">
                          </div>
                    </div>                    
                    <div class="form-group">
                      <label>Deskripsi Artikel</label>
                      <div id="hint" class="help-blocks"></div>
                      <textarea id="deskripsi" name="deskripsi">@if($id!=null){{$posts->deskripsi}}@endif</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>Judul SEO (SEO Title)</label>
                      <input type="text" id="SEOtitle" name="seotitle" class="form-control" maxlength="60" onkeyup="countTitle()" value="@if($id!=null){{$posts->SEOtitle}}@endif">
                      <p class="help-block" style="color: blue;">Jika dikosongkan, maka akan mengambil judul artikel..</p>
                      <div id="countTitle" class="pull-right" style=""><strong>0</strong></div>
                    </div>
                    <div class="form-group">
                      <label>Deskripsi SEO (SEO Description)</label>
                      <textarea id="SEOdesc" name="seodesc" class="form-control" maxlength="160" rows="5" onkeyup="count()">@if($id!=null){{$posts->SEOdesc}}@endif</textarea>
                      <p class="help-block" style="color: blue;">Jika dikosongkan, maka akan mengambil deskripsi artikel..</p>
                      <div id="count" class="pull-right" style=""><strong>0</strong></div>
                    </div>
              </div>
          	</div>
      	</section>
  	</div>
    <div class="col-lg-4">
      <section class="panel">
        <header class="panel-heading">
          Terbitkan
        </header>
        <div class="panel-body">
          <div class="container-fluid">
            <div class="form-group">
              <label class="control-label">Gambar Utama</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                      <a id="lfm1" data-input="thumbnail" data-preview="holder" class="btn btn-warning">
                        <i class="fa fa-picture-o"></i> Pilih
                      </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="foto" value="@if($id!=null){{$posts->foto}}@endif">
                  </div>
                  <div id="hintThumb"></div>
                  <div class="container-fluid">
                    <center><img id="holder" style="margin-top:15px;max-height:100px;" src="@if($id!=null){{$posts->foto}}@endif"></center>
                  </div>
            </div>            
            <div class="form-group">
              <input class="btn btn-danger" form="article" type="submit" name="draft" value="Draft">
              <input class="btn btn-success" form="article" type="submit" name="kirim" value="Kirim">
            </div>
            </form>
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
                  <h4 class="modal-title">Tambah Kategori</h4>
              </div>
              <div class="modal-body">

                <form id="tambahKategori" role="form" action="#" onsubmit="return tambahKategori(this)">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">
                    <label class="control-label">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control">
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
<!-- END MODAL COLLECTIONS -->
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
<script src="/admin/js/common-scripts.js"></script>
  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>

    <script>
        $('#lfm1').filemanager('image');
        CKEDITOR.replace( 'deskripsi' , {
          filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    </script>

    <!-- untok validasi -->
    <script type="text/javascript">
      function countTitle() {
        var val = $('#SEOtitle').val();
        var count = val.length;
          $('#countTitle').text(count);
          if (count==0) {
            document.getElementById("countTitle").style.color = "black";
          } else if(count<=50) {
            document.getElementById("countTitle").style.color = "blue";
          } else {
            document.getElementById("countTitle").style.color = "red";
          }
      }

      function count() {
        var val = $('#SEOdesc').val();
        var count = val.length;
        $('#count').text(count);
        if (count==0) {
          document.getElementById("count").style.color = "black";
        } else if(count<=150) {
          document.getElementById("count").style.color = "blue";
        } else {
          document.getElementById("count").style.color = "red";
        }
      }

      function check(data) {
        if ($('#judul').val() == '') {
          $('#hintjudul').text('Harap isi Judul!');
          document.getElementById("hintjudul").style.color = "red";
          alert('Harap isi Judul!') ;
          return false ;
        }
        var editor_val = CKEDITOR.instances.deskripsi.getData(); ;
        if (editor_val == '') {
          $('#hint').text('Harap isi Deskripsi!');
          document.getElementById("hint").style.color = "red";
          document.getElementById("hint").style.textAlign = "center";
          alert('Harap isi Deskripsi!') ;
          var array = $(data).serialize();
          console.log(array);
          return false ;
        }
        if ($('#thumbnail').val()=='') {
          $('#hintThumb').text('Harap isi Gambar Utama!');
          document.getElementById("hintThumb").style.color = "red";
          alert('Harap isi Gambar Utama!') ;
          return false;
        }
        return true ;
      }
    </script>

    <!-- untok category -->
    <script type="text/javascript">
      $('#category').ready(loadCategory());
      function loadCategory() {
            $.ajax({

              type:"GET",
              url:'/admin/category-data',
              dataType: 'json',
              success: function(data){
                  // console.log(data);
                  var arrayCategory= data;
                  var category = "";
                  for(i=0;i<arrayCategory.length;i++){
                    if(i==0){
                     category += '<input name="category[]" value="'+arrayCategory[i]["id"]+'" type="checkbox" checked/> '+arrayCategory[i]["nama"]+' ';
                    } else {
                     category += '<input name="category[]" value="'+arrayCategory[i]["id"]+'" type="checkbox"/> '+arrayCategory[i]["nama"]+' ';
                    }
                  }
                  if (category=="") {
                  document.getElementById("category").innerHTML = '<div class="container-fluid" style="border: 2px solid;border-radius: 25px; padding:5px;color:red;"><center><strong>Kategori Kosong</strong></center></div>';
                  } else {
                  document.getElementById("category").innerHTML = category;
                  }
              },
              error: function(e) {
                console.log("error");
              }
          });
      }
      function tambahKategori(data) {
        // console.log($(data).serialize());
         $.ajax({

              type:"POST",
              url:'/admin/category',
              data:$(data).serialize(),
              dataType: 'json',
              success: function(data){
                  console.log(data);
              },
          });
         loadCategory();
         $('#modalTambah').modal('hide');
         $('#modalTambah').val('hide');
         return false;
      }
    </script>
@endpush
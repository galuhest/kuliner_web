@extends('adminlte::page')

@section('htmlheader_title')
    Management Kedai
@endsection

@section('contentheader_title')
     Management Kedai
@endsection


@section('main-content')
<div class="row">
  <div class="col-xs-12">
  <h4 style="margin-bottom: 0em;padding-bottom: 0em">Kriteria</h4>
    <form action="{{ route('management.kedai') }}" method="GET">
      <div class="row">
        <div class="col-md-4 form-group">
          <label for="criteria"></label>
          <select id="criteria" name="criteria" class="form-control">
            <option value="name">Nama Kedai</option>
            <option value="outlet_type_id">Tipe Kedai</option>
            <option value="address">Alamat</option>
            <option value="area">Area</option>
          </select>
        </div>

        <div class="col-md-4 form-group">
          <label for="keywords"></label>
          <input type="text" class="form-control" placeholder="query" id="keywords" name="keywords">
        </div>

        <div class="row">
          <div class="col-md-4 pull-right" style="padding-top:1.5em;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a class="create-kedai-btn btn btn-success" data-toggle="modal" data-target="#create-kedai-modal">Tambah Kedai</a>
          </div>
        </div>
      </div>
    </form>

    <br />

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th></th>
                <th>Nama Kedai</th>
                <th>Tipe</th>
                <th>Alamat</th>
                <th>Area</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
          @foreach($outlets as $k => $outlet)
            <tr>
            <td>{{$k+1}}</td>
            <td>
              <button onclick="fillForm('{{$outlet->id}}')" class="edit-kedai-btn btn btn-success" data-toggle="modal" data-target="#create-kedai-modal">Update Kedai</button>
              <button onclick="fillMenuGroup('{{$outlet->id}}', '{{$outlet->name}}', '{{$outlet->address}}')" class="btn btn-success" data-toggle="modal" data-target="#menu_modal">Menu &amp; Harga</button>

            </td>
            <td>{{$outlet->name}}</td>
            <td>{{$outlet->outlet_type->name}}</td>
            <td>{{$outlet->address}}</td>
            <td>{{$outlet->area->name}}</td>
            <td>{{$outlet->longitude}}</td>
            <td>{{$outlet->latitude}}</td>
            <td>{{$outlet->getStatusName()}}</td>
          </tr>
          @endforeach

        </tbody>
    </table>

    <!-- Menu Modal-->
    <div id="menu_modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Menu</h4>
          </div>
          <div class="modal-body">
              <input type="hidden" id="kedai_id" value=""/>
              <input type="hidden" id="selected_menu_group" value=""/>
              <input type="hidden" id="selected_menu_group_name" value=""/>
              <p id="kode_kedai_menu"></p>
              <p id="nama_kedai_menu"></p>
              <p id="alamat_kedai_menu"></p>
              <button class="insert-menu-group-btn btn btn-success"   data-toggle="modal" data-target="#insert_menu_group">Tambah Menu Group</button>
              <table id="menu_group" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th></th>
                        <th>Menu Group</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <button class="btn btn-success insert-menu-btn" onclick="cek_menu()">Tambah Menu</button>
              <table id="menu_detail" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th></th>
                        <th>Menu</th>
                        <th>Harga Saat Ini</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
          </div>

        </div><!-- /.modal-content-->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--Insert Menu Group Modal-->
    <div id="insert_menu_group" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Menu Group</h4>
          </div>
          <div class="modal-body">

                <div class="form-group">
                   <label for="nama">Menu Group</label>
                    <input type="text" name="name" class="form-control" id="namaMenuGroup"/>
               </div>
               <input type="hidden" val=""/>
               <button  class="btn btn-default" data-dismiss="modal">Close</button>
               <button  id="submit_menu_group" onclick="insertMenuGroup()" class="btn btn-primary">Save changes</button>

          </div>

        </div><!-- /.modal-content-->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="insert_menu" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Menu</h4>
          </div>
          <div class="modal-body">
            <p id="menu_group_detail"></p>

                <div class="form-group">
                   <label for="menu_type">Tipe Menu</label>
                   <select id="menu_type" name="menu_type" class="form-control">

                     @foreach($menuTypes as $menuType)
                       <option value="{{$menuType->id}}">{{$menuType->name}}</option>
                     @endforeach
                   </select>
               </div>
               <div class="form-group">
                  <label for="nama_menu">Nama Menu</label>
                   <input type="text" name="nama_menu" class="form-control" id="nama_menu"/>
              </div>
              <div class="form-group">
                 <label for="deskripsi_menu">Menu Alias</label>
                  <input type="text" name="deksripsi_menu" class="form-control" id="deskripsi_menu"/>
             </div>
             <div class="form-group">
                <label for="favourite">Favourite?</label>
                <select id="favourite" name="favourite" class="form-control">
                  <option value="1" selected>Ya</option>
                  <option value="0">Belum</option>
                </select>
            </div>
               <button  class="btn btn-default" data-dismiss="modal">Close</button>
               <button id="submit_menu" onclick="insertMenu()" class="btn btn-primary">Save changes</button>
          </div>

        </div><!-- /.modal-content-->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--Table Price -->
    <div id="harga_modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Harga</h4>
          </div>
          <div class="modal-body">
            <button class="insert-price-btn btn btn-success" data-toggle="modal" data-target="#insert_harga">Tambah Harga</button>
            <table id="harga_detail" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Harga</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

        </div><!-- /.modal-content-->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--Price-->
    <div id="insert_harga" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Harga</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" value="" id="selected_product_id">
            <p id="menu_group_detail"></p>
               <div class="form-group">
                  <label for="price">Harga</label>
                   <input type="number" name="price" class="form-control" id="price"/>
              </div>
              <div class="form-group">
                <label for="end_date">Tanggal Mulai</label>
                <div class="input-group date" data-provide="datepicker">
                  <input type="text" class="datepicker form-control" name="start_date" id="start_date" />
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="end_date">Tanggal Selesai</label>
                <div class="input-group date" data-provide="datepicker">
                  <input type="text" class="datepicker form-control" name="end_date" id="end_date" />
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>
              </div>
               <button  class="btn btn-default" data-dismiss="modal">Close</button>
               <button id="submit_menu" onclick="insertHarga()" class="btn btn-primary">Save changes</button>
          </div>

        </div><!-- /.modal-content-->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



  </div>
</div>

<!-- Modal -->
<div id="create-kedai-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kedai</h4>
            </div>
            <div class="modal-body">
                <form id="create-kedai-form" action="/outlets" method="POST">
                    <div class="form-group">
                        <label for="name">Nama Kedai</label>
                        <input type="name" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Masukkan nama kedai">
                    </div>
                    <div class="form-group">
                        <label for="type">Tipe Kedai</label>
                        <select id="outlet_type_id" name="outlet_type_id" class="form-control">
                          <option value="">Please choose...</option>
                          @foreach ($outletTypes as $type)
                              <option value="{{ $type->id }}">{{ $type->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Alamat</label>
                        <input type="textarea" class="form-control" id="address" name="address" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="area">Area</label>
                        <select id="area_id" name="area_id" class="form-control">
                          <option value="">Please choose...</option>
                          @foreach ($areas as $area)
                              <option value="{{ $area->id }}">{{ $area->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude">
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="0">Non-Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_favourite">Favorit?</label>
                        <select id="is_favourite" name="is_favourite" class="form-control">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
function deleteKedai(id){
    $.getJSON("/outlets/"+id, function (data) {
        $('#delete_form').attr('action','/outlets/'+id);
    })
}

function fillForm(id){
  $.getJSON( "/outlets/"+id, function(data) {
    $('#create-kedai-form').attr('kedai_id', id);
    $('#name').val(data['name']);
    $('#address').val(data['address']);
    $('#description').val(data['description']);
    $('#longitude').val(data['longitude']);
    $('#latitude').val(data['latitude']);
    $('#area_id').val(data['area_id']);
    $('#outlet_type_id').val(data['outlet_type_id']);
    $('#status').val(data['status']);
    $('#is_favourite').val(data['is_favourite']);
    $("#create-kedai-form").attr('action','/outlets/'+id);
  });
}

function fillPrice(id){
  $('#selected_product_id').val(id);
  $.getJSON("/menu/prices/" + id, function(data){
    var hargaList = "";
    for(var i = 0; i < data.length; i++){
      hargaList += '<tr>';
      hargaList += "<td>" + data[i]['id'] + "</td>";
      hargaList += "<td>" + data[i]['price'] + "</td>";
      hargaList += "<td>" + data[i]['start_date'] + "</td>";
      hargaList += "<td>" + (data[i]['end_date'] == null ? '-' :  data[i]['end_date']) + "</td>";
      hargaList += "</tr>";
    }
    $('#harga_detail tbody').empty();
    $("#harga_detail tbody").append(hargaList);
  });
}

function fillMenuGroup(id, nama, alamat){
 $("#menu_detail tbody").empty();
 $('#selected_menu_group').val("")
 document.getElementById('kode_kedai_menu').innerHTML = "Kode : " + id;
 document.getElementById('nama_kedai_menu').innerHTML = "Nama Kedai : " + nama;
 document.getElementById('alamat_kedai_menu').innerHTML = "Alamat : " + alamat;
 $('#kedai_id').val(id);
  $.getJSON("/menu/"+id, function(data){
    var menuGroupList = "";

    for(var i = 0; i < data.length; i++){
      menuGroupList += '<tr id="'+id+'" product_group_id="'+data[i]['id']+'" product_group_name="'+data[i]['name']+'" style="cursor: pointer;" >';
      menuGroupList += "<td>" + data[i]['id'] + "</td>";
      menuGroupList += "<td>Editing Stuff</td>";
      menuGroupList += "<td>" + data[i]['name'] + "</td>";
      menuGroupList += "</tr>";
    }
    $("#menu_group tbody").empty();
    $("#menu_group tbody").append(menuGroupList);
  });
}

function insertHarga(){
  var data = {
                "product_id": $('#selected_product_id').val(),
                "price" : $('#price').val(),
                "start_date": $('#start_date').val(),
                "end_date": $('#end_date').val()
              }
              $.ajax({
                 type:"POST",
                 url:'/menu/prices',
                 data: data,
                 dataType: 'json',
                 success: function(data){
                    var menu_id = $('#selected_product_id').val();
                   $.getJSON("/menu/prices/" + menu_id, function(data){
                     var hargaList = "";
                     for(var i = 0; i < data.length; i++){
                       hargaList += '<tr>';
                       hargaList += "<td>" + data[i]['id'] + "</td>";
                       hargaList += "<td>" + data[i]['price'] + "</td>";
                       hargaList += "<td>" + data[i]['start_date'] + "</td>";
                       hargaList += "<td>" + (data[i]['end_date'] == null ? '-' : data[i]['end_date']) + "</td>";
                       hargaList += "</tr>";
                     }
                     $('#harga_detail tbody').empty();
                     $("#harga_detail tbody").append(hargaList);

                     fillMenuRow(menu_id);
                   });
                    $("#insert_harga").modal('hide');
                 },
                 error: function(err){
                    $('.alert').remove();
                    errors = JSON.parse(err.responseText).message;
                    errorText = '<div class="alert alert-danger"><ul>';
                    Object.keys(errors).map(function(key, index) {
                        errorText += '<li>' + errors[key] + '</li>'
                    });
                    errorText += '</ul></div>';
                    $('#insert_harga .modal-body').prepend(errorText);
                 }
             })
}

function fillMenuRow(id) {
  $.getJSON("/menus/" + id, function(data){
     menu = "<td>" + data['id'] + "</td>";
     menu += '<td><button class="btn btn-success" onclick="fillPrice('+data['id']+')" data-toggle="modal" data-target="#harga_modal">Edit Harga</button></td>';
     menu += "<td>" + data['name'] + "</td>";
     menu += data['price'] == null ? "<td>Harga tidak Ditentukan</td>" : "<td>"+data['price']+"</td>";
     $(".row-menu-" + id).children('td').remove();
     $(".row-menu-" + id).append(menu);
  });

}

function insertMenuGroup(){

  var data = {
       "outlet_id": $('#kedai_id').val(),
       "name": $('#namaMenuGroup').val()
   };
  $.ajax({
     type:"POST",
     url:'/menu/group',
     data: data,
     dataType: 'json',
     success: function(data){
       $.getJSON("/menu/"+$("#kedai_id").val(), function(data){
         var menuGroupList = "";

         for(var i = 0; i < data.length; i++){
           menuGroupList += '<tr id="'+$("#kedai_id").val()+'" product_group_id="'+data[i]['id']+'" product_group_name="'+data[i]['name']+'" style="cursor: pointer;">';
           menuGroupList += "<td>" + data[i]['id'] + "</td>";
           menuGroupList += "<td>Editing Stuff</td>";
           menuGroupList += "<td>" + data[i]['name'] + "</td>";
           menuGroupList += "</tr>"
         }
         $("#menu_group tbody").empty();
         $("#menu_group tbody").append(menuGroupList);
       });
       $("#insert_menu_group").modal('hide');
     },
     error: function(err){
        $('.alert').remove();
        errors = JSON.parse(err.responseText).message;
        errorText = '<div class="alert alert-danger"><ul>';
        Object.keys(errors).map(function(key, index) {
            errorText += '<li>' + errors[key] + '</li>'
        });
        errorText += '</ul></div>';
        $('#insert_menu_group .modal-body').prepend(errorText);
     }
 })
}

function insertMenu(){

  var data = {
       "outlet_id": $('#kedai_id').val(),
       "name": $('#nama_menu').val(),
       "description": $('#deskripsi_menu').val(),
       "product_group_id": $('#selected_menu_group').val(),
       "product_type_id": $('#menu_type').val(),
       "is_favourite": $('#favourite').val()
   };
  $.ajax({
     type:"POST",
     url:'/menu/detail',
     data: data,
     dataType: 'json',
     success: function(data){

       $.getJSON("/menu/"+$("#kedai_id").val()+"/"+$("#selected_menu_group").val(), function(data){
         var menuList = "";

         for(var i = 0; i < data.length; i++){
           menuList += '<tr style="cursor: pointer;">';
           menuList += "<td>" + data[i]['second_id'] + "</td>";
           menuList += '<td><button class="btn btn-success" onclick="fillPrice('+data[i]['second_id']+')" data-toggle="modal" data-target="#harga_modal">Edit Harga</button></td>';
           menuList += "<td>" + data[i]['name'] + "</td>";
           menuList += data[i]['price'] == null ? "<td>Harga tidak Ditentukan</td>" : "<td>"+data[i]['price']+"</td>";
           menuList += "</tr>"
         }
         $("#menu_detail tbody").empty();
         $("#menu_detail tbody").append(menuList);
       });
       $("#insert_menu").modal('hide');
     },
     error: function(err){
        $('.alert').remove();
        errors = JSON.parse(err.responseText).message;
        errorText = '<div class="alert alert-danger"><ul>';
        Object.keys(errors).map(function(key, index) {
            errorText += '<li>' + errors[key] + '</li>'
        });
        errorText += '</ul></div>';
        $('#insert_menu .modal-body').prepend(errorText);
     }
 });
}

function cek_menu(){
  var menu_group = $('#selected_menu_group').val();
  if(menu_group == ""){
    alert('Silahkan Pilih Menu Group Terlebih Dahulu');
  }else{
    clearMenu();
    $('#insert_menu').modal('show');
    $('#menu_group_detail').empty();
    $('#menu_group_detail').append("Menu Group : " + $('#selected_menu_group_name').val());
  }
}

function clearMenu(){
  $('#nama_menu').val("");
  $('#deskripsi_menu').val("");
  $('#menu_type').val("1");
  $('#favourite').val("1");
}
$( document ).ready(function() {
  $.noConflict();

  $('.insert-menu-group-btn').click(function() {
    $('.alert').remove();
    $('#name').val('');
  });

  $('.insert-menu-btn').click(function() {
     $('.alert').remove();
     $('#nama_menu').val(''),
     $('#deskripsi_menu').val(''),
     $('#favourite').val('0')
  });


  $('.insert-price-btn').click(function() {
    $('.alert').remove();
    $('#price').val('');
    $('#start_date').val('');
    $('#end_date').val('');
  });

  $('.edit-kedai-btn').click(function() {
    $('.alert').remove();
    $('#create-kedai-modal .modal-title').text('Edit Kedai');
    var kedai_id = $(this).attr('kedai_id');
    $('#create-kedai-form').attr('method', 'PUT');
  });

  $('.create-kedai-btn').click(function() {
    $('.alert').remove();
    $('#name').val('');
    $('#address').val('');
    $('#description').val('');
    $('#longitude').val('');
    $('#latitude').val('');
    $('#area_id').val('');
    $('#outlet_type_id').val('');
    $('#status').val(1);
    $('#is_favourite').val(0);
    $('#create-kedai-modal .modal-title').text('Tambah Kedai');
    $('#create-kedai-form').attr('kedai_id', '');
    $('#create-kedai-form').attr('method', 'POST');
  });

  $('#create-kedai-form').submit(function (e) {
      e.preventDefault();
      kedaiData = $('#create-kedai-form').serializeArray();
      var kedai_id = $('#create-kedai-form').attr('kedai_id');
      var url = kedai_id == '' ? "{{url('outlets')}}" : "{{url('outlets')}}" + '/' + kedai_id 
      
      $.ajax({
          url: url,
          method: $('#create-kedai-form').attr('method'),
          data: kedaiData,
      }).done(function (result) {
          $('.alert').remove();
          location.reload();
      }).fail(function (err, result) {
          $('.alert').remove();
          errors = JSON.parse(err.responseText).message;
          errorText = '<div class="alert alert-danger"><ul>';
          Object.keys(errors).map(function(key, index) {
              errorText += '<li>' + errors[key] + '</li>'
          });
          errorText += '</ul></div>';
          $('#create-kedai-modal .modal-body').prepend(errorText);
      });
  });

  $(document).on("click", "#menu_group tbody tr", function(e) {
    $('#menu_group tbody tr').removeClass('area-selected');
    $(this).addClass('area-selected');
    $('#selected_menu_group').val($(this).attr('product_group_id'));
    $('#selected_menu_group_name').val($(this).attr('product_group_name'));

    $.ajax({
       type:"GET",
       url:'/menu/'+this.id + '/'+$(this).attr('product_group_id'),
       dataType: 'json',
       success: function(data){
         var menuList = "";

         for(var i = 0; i < data.length; i++){
           menuList += '<tr class="row-menu-' + data[i]['second_id'] + '"" style="cursor: pointer;">';
           menuList += "<td>" + data[i]['second_id'] + "</td>";
           menuList += '<td><button class="btn btn-success" onclick="fillPrice('+data[i]['second_id']+')" data-toggle="modal" data-target="#harga_modal">Edit Harga</button></td>';
           menuList += "<td>" + data[i]['name'] + "</td>";
           menuList += data[i]['price'] == null ? "<td>Harga tidak Ditentukan</td>" : "<td>"+data[i]['price']+"</td>";
           menuList += "</tr>"
         }
         $("#menu_detail tbody").empty();
         $("#menu_detail tbody").append(menuList);
       },
       error: function(data){
         alert('error');
       }
   })
  });
});
</script>
@endsection

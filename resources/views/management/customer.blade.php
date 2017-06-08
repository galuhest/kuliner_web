@extends('adminlte::page')

@section('htmlheader_title')
	Management Pelanggan
@endsection

@section('contentheader_title')
     Management Pelanggan
@endsection


@section('main-content')
<div class="row">
  <div class="col-xs-12">
  <h4 style="margin-bottom: 0em;padding-bottom: 0em">Kriteria</h4>
    <form>
      <div class="row">
        <div class="col-md-4 form-group">
          <label for="wilayah"></label>
          <select id="criteria" name="criteria" class="form-control">
            <option value="email">Username</option>
            <option value="name">Nama</option>
            <option value="address">Wilayah</option>
            <option value="phone_number">Nomor HP</option>
            <option value="address">Alamat</option>
          </select>
        </div>

        <div class="col-md-4 form-group">
          <label for="wilayah"></label>
          <input type="text" class="form-control" placeholder="query" id="keywords" name="keywords">
        </div>

        <div class="row">
          <div class="col-md-4 pull-right" style="padding-top:1.5em;">
            <button type="submit" class="btn btn-primary">Filter</button>
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
                <th>Username</th>
                <th>Nama</th>
                <th>Nomor HP</th>
                <th>Alamat</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Member</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $k => $user)
            <tr>
                <td>{{ $k+1 }}</td>
                <td><button type="button" class="edit-user-btn btn btn-success" data-toggle="modal" data-target="#update_modal" cust_id="{{ $user->id }}">Update User</></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->address }}</td>
                <td>0</td>
                <td>0</td>
                <td>{{ $user->isMember() ? 'Ya' : 'Tidak' }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<div id="update_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update User</h4>
            </div>
            <div class="modal-body">
                <form id="update_form" action="/users" method="POST">
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">No Telepon</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Nomor Telepon">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="textarea" class="form-control" id="address" name="address" placeholder="Alamat">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>

    $(document).ready(function() {
        $('.edit-user-btn').click(function() {
            var customer_id = $(this).attr('cust_id');
            fillForm(customer_id);
            $('#update_form').attr('cust_id', customer_id);
            $('#update_form').attr('method', 'PUT');
        });

        $('#update_form').submit(function (e) {
            e.preventDefault();
            custData = $('#update_form').serializeArray();
            var customer_id = $('#update_form').attr('cust_id');
            var url = customer_id == '' ? "{{url('users')}}" : "{{url('users')}}" + '/' + customer_id

            $.ajax({
                url: url,
                method: $('#update_form').attr('method'),
                data: custData,
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
                $('#update_modal .modal-body').prepend(errorText);
            });
        });
    });

    function fillForm(id){
        $.getJSON("/users/"+id, function (data) {
            $('#email').val(data['email']);
            $('#name').val(data['name']);
            $('#phone_number').val(data['phone_number']);
            $('#address').val(data['address']);
            $('#update_form').attr('action','/users/'+id);
        })
    }
</script>

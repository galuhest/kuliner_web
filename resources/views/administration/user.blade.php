@extends('adminlte::page')

@section('htmlheader_title')
	Management User
@endsection

@section('contentheader_title')
     Management User
@endsection


@section('main-content')
<div class="row">
  <div class="col-xs-12">
  <h4 style="margin-bottom: 0em;padding-bottom: 0em">Kriteria</h4>
    <form action="{{ route('administration.user') }}" method="GET">
      <div class="row">
        <div class="col-md-4 form-group">
          <label for="wilayah"></label>
          <select id="criteria" name="criteria" class="form-control">
            <option value="email">Username</option>
            <option value="name">Nama</option>
            <option value="role">Jabatan</option>
          </select>
        </div>

        <div class="col-md-4 form-group">
          <label for="query"></label>
          <input type="text" class="form-control" placeholder="query" id="keywords" name="keywords">
        </div>

        <div class="row">
          <div class="col-md-4 pull-right" style="padding-top:1.5em;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <button type="button" class="create-user-btn btn btn-success" data-toggle="modal" data-target="#create-user-modal">Tambah User</button>
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
                <th></th>
                <th>Username</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Kedai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $k => $user)
            <tr>
                <td>{{ $k+1 }}</td>
                <td></td>
                <td><button type="button" class="delete-user-btn btn btn-danger" data-toggle="modal" user_id="{{ $user->id }}" data-target="#delete_modal">Delete</button></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->getRoleName() }}</td>
                <td>
                    @if ($user->outlet)
                        {{ $user->outlet->name }}
                    @endif
                </td>
                <td>{{ $user->isActivated() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<div id="create-user-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah User</h4>
            </div>
            <div class="modal-body">
                <form id="create-user-form" action="/users" method="POST">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
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
                    <div class="form-group">
                        <label for="role">Jabatan</label>
                        <select id="role" name="role" class="form-control">
                        <option value="">Please choose...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="0">Non-aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div id="delete_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete User</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure want to delete this user?</h3>
                <form id="delete_form" action="/users" method="POST">
                    {{ method_field('delete') }}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
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
        $('.create-user-btn').click(function() {
            $('.alert').remove();
        });

        $('.delete-user-btn').click(function() {
            var user_id = $(this).attr('user_id')
            $('#delete_form').attr('user_id', user_id);
        });


        $('#create-user-form').submit(function (e) {
            e.preventDefault();
            userData = $('#create-user-form').serializeArray();
            $.ajax({
                url: "{{url('users')}}",
                method: 'POST',
                data: userData,
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
                $('#create-user-modal .modal-body').prepend(errorText);
            });
        });

        $('#delete_form').submit(function (e) {
            e.preventDefault();
            userData = $('#delete_form').serializeArray();
            var user_id = $('#delete_form').attr('user_id');
            var url = user_id == '' ? "{{url('users')}}" : "{{url('users')}}" + '/' + user_id
            $.ajax({
                url: url,
                method: 'POST',
                data: userData,
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
                $('#create-user-modal .modal-body').prepend(errorText);
            });
        });
    });

    function deleteUser(id){
        $.getJSON("/users/"+id, function (data) {
            $('#delete_form').attr('action','/users/'+id);
        })
    }
</script>
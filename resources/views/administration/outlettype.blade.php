@extends('adminlte::page')

@section('htmlheader_title')
	Management Tipe Outlet
@endsection

@section('contentheader_title')
     Management Tipe Outlet
@endsection


@section('main-content')
<div class="row">
  <div class="col-xs-12">
    <button type="button" class="create-outlet-type-btn btn btn-success" data-toggle="modal" data-target="#create-outlet-type-modal">Tambah Tipe Outlet</button>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th></th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($outletTypes as $k => $outletType)
            <tr>
                <td>{{ $k+1 }}</td>
                <td>
                    <button type="button" class="edit-outlet-type-btn btn btn-primary" data-toggle="modal" outlet_type_id="{{ $outletType->id }}" data-target="#edit-outlet-type-modal" onclick="fillOutletType()">Edit</button>
                    <button type="button" class="delete-outlet-type-btn btn btn-danger" data-toggle="modal" outlet_type_id="{{ $outletType->id }}" data-target="#delete_modal">Delete</button>
                </td>
                <td>{{ $outletType->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<div id="create-outlet-type-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Tipe Outlet</h4>
            </div>
            <div class="modal-body">
                <form id="create-outlet-type-form">
                    <input type="hidden" class="form-control" id="edit-outlet-type-id" name="id" placeholder="Nama">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
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
<div id="edit-outlet-type-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Tipe Outlet</h4>
            </div>
            <div class="modal-body">
                <form id="edit-outlet-type-form">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="edit-name" name="name" placeholder="Nama">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
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
                <h4 class="modal-title">Delete Tipe Outlet</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure want to delete this outlet type?</h3>
                <form id="delete_form" action="/outlet-type" method="POST">
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
        $('.delete-outlet-type-btn').click(function() {
            var outlet_type_id = $(this).attr('outlet_type_id')
            $('#delete_form').attr('outlet_type_id', outlet_type_id);
        });

        $('#create-outlet-type-form').submit(function (e) {
            e.preventDefault();
            outletTypeData = $('#create-outlet-type-form').serializeArray();
            $.ajax({
                url: "{{url('outlet-types')}}",
                method: 'POST',
                data: outletTypeData,
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
                $('#create-outlet-type-modal .modal-body').prepend(errorText);
            });
        });

        $('#edit-outlet-type-form').submit(function (e) {
            e.preventDefault();
            outletTypeData = $('#edit-outlet-type-form').serializeArray();
            console.log('hoho');
            $.ajax({
                url: "{{url('outlet-types')}}" + "/" + $('#edit-outlet-type-id').attr('value'),
                method: 'PUT',
                data: outletTypeData,
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
                $('#edit-outlet-type-modal .modal-body').prepend(errorText);
            });
        });

        $('#delete_form').submit(function (e) {
            e.preventDefault();
            outletType = $('#delete_form').serializeArray();
            var outlet_type_id = $('#delete_form').attr('outlet_type_id');
            var url = "{{url('outlet-types')}}" + '/' + outlet_type_id;
            $.ajax({
                url: url,
                method: 'POST',
                data: outletType,
            }).done(function (result) {
                $('.alert').remove();
                location.reload();
            }).fail(function (err, result) {
                $('.alert').remove();
                errorText = '<div class="alert alert-danger">Tidak dapat menghapus tipe outlet karena ada kedai/toko yang menggunakan tipe outlet ini</div>';
                $('#delete_modal .modal-body').prepend(errorText);
            });
        });
    });

    function fillOutletType() {
        var outlet_type_id = $('.edit-outlet-type-btn').attr('outlet_type_id');
        $.getJSON("/outlet-types/"+outlet_type_id, function (data) {
            $('#edit-outlet-type-id').attr('value', outlet_type_id);
            $('#edit-name').attr('value', data.name);
        });
    }
</script>
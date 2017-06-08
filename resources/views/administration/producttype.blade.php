@extends('adminlte::page')

@section('htmlheader_title')
	Management Tipe Produk
@endsection

@section('contentheader_title')
     Management Tipe Produk
@endsection


@section('main-content')
<div class="row">
  <div class="col-xs-12">
    <button type="button" class="create-product-type-btn btn btn-success" data-toggle="modal" data-target="#create-product-type-modal">Tambah Tipe Produk</button>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th></th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($productTypes as $k => $productType)
            <tr>
                <td>{{ $k+1 }}</td>
                <td>
                    <button type="button" class="edit-product-type-btn btn btn-primary" data-toggle="modal" product_type_id="{{ $productType->id }}" data-target="#edit-product-type-modal" onclick="fillproductType(this)">Edit</button>
                    <button type="button" class="delete-product-type-btn btn btn-danger" data-toggle="modal" product_type_id="{{ $productType->id }}" data-target="#delete_modal">Delete</button>
                </td>
                <td>{{ $productType->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<div id="create-product-type-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Tipe Produk</h4>
            </div>
            <div class="modal-body">
                <form id="create-product-type-form">
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
<div id="edit-product-type-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Tipe Produk</h4>
            </div>
            <div class="modal-body">
                <form id="edit-product-type-form">
                    <input type="hidden" class="form-control" id="edit-product-type-id" name="id" placeholder="Nama">
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
                <h4 class="modal-title">Delete Tipe Produk</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure want to delete this product type?</h3>
                <form id="delete_form" action="/product-type" method="POST">
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
        $('.delete-product-type-btn').click(function() {
            var product_type_id = $(this).attr('product_type_id')
            $('#delete_form').attr('product_type_id', product_type_id);
        });

        $('#create-product-type-form').submit(function (e) {
            e.preventDefault();
            productTypeData = $('#create-product-type-form').serializeArray();
            $.ajax({
                url: "{{url('product-types')}}",
                method: 'POST',
                data: productTypeData,
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
                $('#create-product-type-modal .modal-body').prepend(errorText);
            });
        });

        $('#edit-product-type-form').submit(function (e) {
            e.preventDefault();
            productTypeData = $('#edit-product-type-form').serializeArray();
            $.ajax({
                url: "{{url('product-types')}}" + "/" + $('#edit-product-type-id').attr('value'),
                method: 'PUT',
                data: productTypeData,
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
                $('#edit-product-type-modal .modal-body').prepend(errorText);
            });
        });

        $('#delete_form').submit(function (e) {
            e.preventDefault();
            productType = $('#delete_form').serializeArray();
            var product_type_id = $('#delete_form').attr('product_type_id');
            var url = "{{url('product-types')}}" + '/' + product_type_id;
            $.ajax({
                url: url,
                method: 'POST',
                data: productType,
            }).done(function (result) {
                $('.alert').remove();
                location.reload();
            }).fail(function (err, result) {
                $('.alert').remove();
                errorText = '<div class="alert alert-danger">Tidak dapat menghapus tipe produk karena ada kedai/toko yang menggunakan tipe produk ini</div>';
                $('#delete_modal .modal-body').prepend(errorText);
            });
        });
    });

    function fillproductType(btn) {
        var product_type_id = $(btn).attr('product_type_id');
        $.getJSON("/product-types/"+product_type_id, function (data) {
            $('#edit-product-type-id').attr('value', product_type_id);
            $('#edit-name').attr('value', data.name);
        });
    }
</script>
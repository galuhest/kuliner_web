@extends('adminlte::page')

@section('htmlheader_title')
	Management Lokasi &amp; Territory
@endsection

@section('contentheader_title')
     Management Lokasi &amp; Territory
@endsection


@section('main-content')
<!-- <iframe
  id="map"
  width="100%"
  height="300"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAo97AORNguOhI0QGd05-CDV4XjRBQWwS0 
    &q=Universitas Indonesia" allowfullscreen>
</iframe> -->
<div class="row">
    <div class="col-sm-4">
        <h3 class="text-center">
            Kawasan
            <button type="button" class="btn-action create-region-btn btn btn-primary" data-toggle="modal" data-target="#create-region-modal">Tambah Kawasan</button>
        </h3>
        <table id="region-tbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead style="font-weight:bold;">
                <td>No.</td>
                <td></td>
                <td>Kawasan</td>
            </thead>
            <tbody>
                @foreach ($regions as $k => $region)
                    <tr class="region-btn" onclick="goToMaps(this); getDistrict(this, {{ $region->id }})" long="{{ $region->longitude }}" lat="{{ $region->latitude }}">
                        <td>{{ $k + 1 }}</td>
                        <td>
                            <button type="button" class="btn-action edit-region-btn btn btn-primary" data-toggle="modal" region_id="{{ $region->id }}" data-target="#edit-region-modal">Edit</button>
                            <button type="button" class="btn-action  delete-region-btn btn btn-danger" data-toggle="modal" region_id="{{ $region->id }}" data-target="#delete-region-modal">Delete</button>
                        </td>
                        <td>{{ $region->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-4">
        <h3 class="text-center">
            Subarea
            <button type="button" class="btn-action create-district-btn btn btn-primary" data-toggle="modal" data-target="#create-district-modal">Tambah Subarea</button>
        </h3>
        <table id="district-tbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead style="font-weight:bold;">
                <td>No.</td>
                <td></td>
                <td>Subarea</td>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-sm-4">
        <h3 class="text-center">
            Area
            <button type="button" class="create-area-btn btn btn-primary" data-toggle="modal" data-target="#create-area-modal">Tambah Area</button>
        </h3>
        <table id="area-tbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead style="font-weight:bold;">
                <td>No.</td>
                <td></td>
                <td>Area</td>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="create-region-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kawasan</h4>
            </div>
            <div class="modal-body">
                <form id="create-region-form">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="name">Longititude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longititude">
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude">
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
<div id="edit-region-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Kawasan</h4>
            </div>
            <div class="modal-body">
                <form id="edit-region-form">
                    <input type="hidden" class="form-control" id="edit-region-id" name="id">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="edit-region-name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="name">Longititude</label>
                        <input type="text" class="form-control" id="edit-region-longitude" name="longitude" placeholder="Longititude">
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="text" class="form-control" id="edit-region-latitude" name="latitude" placeholder="Latitude">
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
<div id="delete-region-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Kawasan</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure want to delete this region?</h3>
                <form id="delete-region-form" action="/regions" method="POST">
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

<!-- Modal -->
<div id="create-district-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Subarea</h4>
            </div>
            <div class="modal-body">
                <form id="create-district-form">
                    <input type="hidden" class="form-control" id="create-district-region-id" name="region_id">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="create-district-name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="name">Longititude</label>
                        <input type="text" class="form-control" id="create-district-longitude" name="longitude" placeholder="Longititude">
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="text" class="form-control" id="create-district-latitude" name="latitude" placeholder="Latitude">
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
<div id="edit-district-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Subarea</h4>
            </div>
            <div class="modal-body">
                <form id="edit-district-form">
                    <input type="hidden" class="form-control" id="edit-district-id" name="id">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="edit-district-name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="name">Longititude</label>
                        <input type="text" class="form-control" id="edit-district-longitude" name="longitude" placeholder="Longititude">
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="text" class="form-control" id="edit-district-latitude" name="latitude" placeholder="Latitude">
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
<div id="delete-district-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Subarea</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure want to delete this district?</h3>
                <form id="delete-district-form" action="/districts" method="POST">
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

<!-- Modal -->
<div id="create-area-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Area</h4>
            </div>
            <div class="modal-body">
                <form id="create-area-form">
                    <input type="hidden" class="form-control" id="create-area-district-id" name="district_id">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="create-area-name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="name">Longititude</label>
                        <input type="text" class="form-control" id="create-area-longitude" name="longitude" placeholder="Longititude">
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="text" class="form-control" id="create-area-latitude" name="latitude" placeholder="Latitude">
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
<div id="edit-area-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Area</h4>
            </div>
            <div class="modal-body">
                <form id="edit-area-form">
                    <input type="hidden" class="form-control" id="edit-area-id" name="id">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="edit-area-name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="name">Longititude</label>
                        <input type="text" class="form-control" id="edit-area-longitude" name="longitude" placeholder="Longititude">
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="text" class="form-control" id="edit-area-latitude" name="latitude" placeholder="Latitude">
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
<div id="delete-area-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Area</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure want to delete this area?</h3>
                <form id="delete-area-form" action="/areas" method="POST">
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
    function goToMaps(dom) {
        long = $(dom).attr('long');
        lat = $(dom).attr('lat');
        // $("#map").attr('src', 'https://www.google.com/maps/embed/v1/place?key=AIzaSyAo97AORNguOhI0QGd05-CDV4XjRBQWwS0&q=' + long + ',' + lat);
    }

    function getDistrict(dom, region_id) {
        $.getJSON("/regions/" + region_id + "/districts", function (result) {
            var html = '';
            html += '<tbody>';
            for (var i = 0; i < result.data.length; i++) {
                var district = result.data[i];
                html += '<tr class="district-btn" onclick="goToMaps(this); getArea(this, ' + district.id + ')" long="' + district.longitude + '" lat="' + district.latitude + '">' +
                        '<td>' + (i + 1) + '</td>' + 
                        '<td>' + 
                            '<button type="button" class="btn-action edit-district-btn btn btn-primary" data-toggle="modal" district_id="' + district.id + '" data-target="#edit-district-modal">Edit</button>' + ' ' + 
                            '<button type="button" class="btn-action delete-district-btn btn btn-danger" data-toggle="modal" district_id="' + district.id + '" data-target="#delete-district-modal">Delete</button>' +
                        '</td>' +
                        '<td>' + district.name + '</td>' +
                        '</tr>'
            }
            html += '</tbody>';

            $('#create-district-region-id').val(region_id);
            $('#create-area-district-id').val('');

            $("#region-tbl > tbody > tr").removeClass('area-selected');
            $("#district-tbl > tbody > tr").removeClass('area-selected');
            $(dom).addClass('area-selected');
            
            $("#district-tbl").children('tbody').remove();
            $("#area-tbl").children('tbody').remove();
            $("#district-tbl").attr('region_id', region_id);
            $("#district-tbl").append(html);

            $('.edit-district-btn').click(function () {
                var district_id = $(this).attr('district_id');
                $.getJSON("/districts/" + district_id, function (data) {
                    $('#edit-district-id').val(district_id);
                    $('#edit-district-name').val(data.name);
                    $('#edit-district-longitude').val(data.longitude);
                    $('#edit-district-latitude').val(data.latitude);
                });
            });

            $('.delete-district-btn').click(function() {
                var district_id = $(this).attr('district_id')
                $('#delete-district-modal').attr('district_id', district_id);
            });
        });
    }

    function getArea(dom, district_id) {
        $.getJSON("/districts/" + district_id + "/areas", function (result) {
            var html = '';
            html += '<tbody>';
            for (var i = 0; i < result.data.length; i++) {
                var area = result.data[i];
                html += '<tr class="area-btn" onclick="selectArea(this); goToMaps(this)" long="' + area.longitude + '" lat="' + area.latitude + '">' +
                        '<td>' + (i + 1) + '</td>' + 
                        '<td>' + 
                            '<button type="button" class="btn-action edit-area-btn btn btn-primary" data-toggle="modal" area_id="' + area.id + '" data-target="#edit-area-modal">Edit</button>' + ' ' +
                            '<button type="button" class="btn-action delete-area-btn btn btn-danger" data-toggle="modal" area_id="' + area.id + '" data-target="#delete-area-modal">Delete</button>' +
                        '</td>' +
                        '<td>' + area.name + '</td>' +
                        '</tr>'
            }
            html += '</tbody>';

            $('#create-area-district-id').val(district_id);

            $("#district-tbl > tbody > tr").removeClass('area-selected');
            $("#area-tbl > tbody > tr").removeClass('area-selected');
            $(dom).addClass('area-selected');
            $("#area-tbl").children('tbody').remove();
            $("#area-tbl").attr('district_id', district_id);
            $("#area-tbl").append(html);

            $('.edit-area-btn').click(function () {
                var area_id = $(this).attr('area_id');
                $.getJSON("/areas/" + area_id, function (data) {
                    $('#edit-area-id').val(area_id);
                    $('#edit-area-name').val(data.name);
                    $('#edit-area-longitude').val(data.longitude);
                    $('#edit-area-latitude').val(data.latitude);
                });
            });

            $('.delete-area-btn').click(function() {
                var area_id = $(this).attr('area_id')
                $('#delete-area-modal').attr('area_id', area_id);
            });
        });
    }

    function selectArea(dom) {
        $("#area-tbl > tbody > tr").removeClass('area-selected');
        $(dom).addClass('area-selected');
    }

    $(document).ready(function() {
        $('.btn-action').click(function() {
            $('.alert').remove();
        });

        $('.edit-region-btn').click(function () {
            var region_id = $(this).attr('region_id');
            $.getJSON("/regions/" + region_id, function (data) {
                $('#edit-region-id').val(region_id);
                $('#edit-region-name').val(data.name);
                $('#edit-region-longitude').val(data.longitude);
                $('#edit-region-latitude').val(data.latitude);
            });
        });

        $('.delete-region-btn').click(function() {
            var region_id = $(this).attr('region_id')
            $('#delete-region-modal').attr('region_id', region_id);
        });

        $('#create-region-form').submit(function (e) {
            e.preventDefault();
            regionData = $('#create-region-form').serializeArray();
            $.ajax({
                url: "{{url('regions')}}",
                method: 'POST',
                data: regionData,
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
                $('#create-region-modal .modal-body').prepend(errorText);
            });
        });

        $('#edit-region-form').submit(function (e) {
            e.preventDefault();
            regionData = $('#edit-region-form').serializeArray();
            $.ajax({
               url: "{{url('regions')}}" + "/" + $('#edit-region-id').attr('value'),
                method: 'PUT',
                data: regionData,
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
                $('#edit-region-modal .modal-body').prepend(errorText);
            });
        });

       $('#delete-region-modal').submit(function (e) {
            e.preventDefault();
            regionData = $('#delete-region-form').serializeArray();
            var region_id = $('#delete-region-modal').attr('region_id');
            var url = "{{url('regions')}}" + '/' + region_id;
            $.ajax({
                url: url,
                method: 'POST',
                data: regionData,
            }).done(function (result) {
                $('.alert').remove();
                location.reload();
            }).fail(function (err, result) {
                $('.alert').remove();
                errorText = '<div class="alert alert-danger">Tidak dapat menghapus region karena ada district/kedai/toko dalam region ini</div>';
                $('#delete-region-modal .modal-body').prepend(errorText);
            });
        });

       $('#create-district-form').submit(function (e) {
            e.preventDefault();
            districtData = $('#create-district-form').serializeArray();
            $.ajax({
                url: "{{url('districts')}}",
                method: 'POST',
                data: districtData,
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
                $('#create-district-modal .modal-body').prepend(errorText);
            });
        });

       $('#edit-district-form').submit(function (e) {
            e.preventDefault();
            districtData = $('#edit-district-form').serializeArray();
            $.ajax({
               url: "{{url('districts')}}" + "/" + $('#edit-district-id').attr('value'),
                method: 'PUT',
                data: districtData,
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
                $('#edit-district-modal .modal-body').prepend(errorText);
            });
        });

       $('#delete-district-modal').submit(function (e) {
            e.preventDefault();
            districtData = $('#delete-district-form').serializeArray();
            var district_id = $('#delete-district-modal').attr('district_id');
            var url = "{{url('districts')}}" + '/' + district_id;
            $.ajax({
                url: url,
                method: 'POST',
                data: districtData,
            }).done(function (result) {
                $('.alert').remove();
                location.reload();
            }).fail(function (err, result) {
                $('.alert').remove();
                errorText = '<div class="alert alert-danger">Tidak dapat menghapus subarea karena ada area/kedai/toko dalam subarea ini</div>';
                $('#delete-district-modal .modal-body').prepend(errorText);
            });
        });

       $('#create-area-form').submit(function (e) {
            e.preventDefault();
            areaData = $('#create-area-form').serializeArray();
            $.ajax({
                url: "{{url('areas')}}",
                method: 'POST',
                data: areaData,
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
                $('#create-area-modal .modal-body').prepend(errorText);
            });
        });

       $('#edit-area-form').submit(function (e) {
            e.preventDefault();
            areaData = $('#edit-area-form').serializeArray();
            $.ajax({
               url: "{{url('areas')}}" + "/" + $('#edit-area-id').attr('value'),
                method: 'PUT',
                data: areaData,
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
                $('#edit-area-modal .modal-body').prepend(errorText);
            });
        });

       $('#delete-area-modal').submit(function (e) {
            e.preventDefault();
            areaData = $('#delete-area-form').serializeArray();
            var area_id = $('#delete-area-modal').attr('area_id');
            var url = "{{url('areas')}}" + '/' + area_id;
            $.ajax({
                url: url,
                method: 'POST',
                data: areaData,
            }).done(function (result) {
                $('.alert').remove();
                location.reload();
            }).fail(function (err, result) {
                $('.alert').remove();
                errorText = '<div class="alert alert-danger">Tidak dapat menghapus subarea karena ada area/kedai/toko dalam subarea ini</div>';
                $('#delete-area-modal .modal-body').prepend(errorText);
            });
        });
    });
</script>
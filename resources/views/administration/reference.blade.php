@extends('adminlte::page')

@section('htmlheader_title')
	Management Reference
@endsection

@section('contentheader_title')
     Management Reference
@endsection


@section('main-content')
<div class="row">
  <div class="col-xs-12">
  <h4 style="margin-bottom: 0em;padding-bottom: 0em">Kriteria</h4>
    <form>
      <div class="row">
        <div class="col-md-4 form-group">
          <label for="wilayah"></label>
          <select class="form-control">
            <option>Kategori</option>
            <option>Parameter</option>
          </select>
        </div>

        <div class="col-md-4 form-group">
          <label for="query"></label>
          <input type="text" class="form-control" placeholder="query" id="query">
        </div>

        <div class="row">
          <div class="col-md-4 pull-right" style="padding-top:1.5em;">
            <a type="submit" class="btn btn-primary">Filter</a>
            <a type="submit" class="btn btn-success">Tambah Reference</a>
          </div>
        </div>
      </div>
    </form>

    <br />

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Parameter</th>
                <th>Value</th>
                <th>Description</th>
                <th>Created Date</th>
                <th>Created By</th>
                <th>Updated Date</th>
                <th>Updated By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>activation_code</td>
                <td>length</td>
                <td>12</td>
                <td>Panjang Kode Aktivasi</td>
                <td>29-05-2016</td>
                <td>Admin</td>
                <td>12-06-2016</td>
                <td>Admin</td>
            </tr>
            <tr>
                <td>2</td>
                <td>phone_number</td>
                <td>length</td>
                <td>11-13</td>
                <td>Kriteria nomor hp</td>
                <td>29-05-2016</td>
                <td>Admin</td>
                <td>12-06-2016</td>
                <td>Admin</td>
            </tr>
            <tr>
                <td>3</td>
                <td>discount_type</td>
                <td>D</td>
                <td>Diskon Reguler</td>
                <td>Tipe Diskon</td>
                <td>22-04-2016</td>
                <td>Admin</td>
                <td>02-06-2016</td>
                <td>Admin</td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection

@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
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
            <option>Username</option>
            <option>Nama</option>
            <option>Wilayah</option>
            <option>Nomor HP</option>
            <option>Alamat</option>
          </select>
        </div>

        <div class="col-md-4 form-group">
          <label for="wilayah"></label>
          <input type="text" class="form-control" placeholder="query" id="query">
        </div>

        <div class="row">
          <div class="col-md-4 pull-right" style="padding-top:1.5em;">
            <a type="submit" class="btn btn-primary">Filter</a>
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
                <th>Nomor HP</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Member</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td>varid.airlangga07@gmail.com</td>
                <td>Varid Airlangga</td>
                <td>087888824974</td>
                <td>Cibubur</td>
                <td>BOGOR</td>
                <td></td>
                <td></td>
                <td>Tidak</td>
            </tr>
            <tr>
                <td>2</td>
                <td></td>
                <td></td>
                <td>budi@email.com</td>
                <td>Budiman</td>
                <td></td>
                <td>Jl.Kartini No.332</td>
                <td>DEPOK</td>
                <td></td>
                <td></td>
                <td>Tidak</td>
            </tr>
            <tr>
                <td>3</td>
                <td></td>
                <td></td>
                <td>dodi@email.com</td>
                <td>Dodi</td>
                <td></td>
                <td>Jl.Kartini No.222</td>
                <td>DEPOK</td>
                <td></td>
                <td></td>
                <td>Tidak</td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection

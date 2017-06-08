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
            <option>KODE AKTIVASI</option>
            <option>USERNAME</option>
            <option>NAMA</option>
            <option>WAKTU AKTIVASI</option>
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
                <th>Kode Registrasi</th>
                <th>Status</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Waktu Registrasi</th>
                <th>Aktifasi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td></td>
                <td>435BC24A21</td>
                <td>NON AKTIF</td>
                <td>dira@gmail.com</td>
                <td>PAK DIRA</td>
                <td>05-07-2016 23:01:32</td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td></td>
                <td>SIJDAOO11</td>
                <td>AKTIF</td>
                <td>test@gmail.com</td>
                <td>TEST</td>
                <td>05-07-2017 23:01:33</td>
                <td>08-09-2017 21:02:00</td>
            </tr>
            <tr>
                <td>3</td>
                <td></td>
                <td>SIJDADUHA9</td>
                <td>AKTIF</td>
                <td>test@gmail.com</td>
                <td>TEST</td>
                <td>05-07-2017 23:01:33</td>
                <td>08-09-2017 21:02:00</td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection

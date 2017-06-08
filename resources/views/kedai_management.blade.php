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
            <option>Nama Kedai</option>
            <option>Kode</option>
            <option>Tipe Kedai</option>
            <option>Kelas Kedai</option>
            <option>Alamat</option>
            <option>Kota</option>
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
                <th></th>
                <th></th>
                <th>Kode</th>
                <th>Nama Kedai</th>
                <th>Tipe</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>RM Padang</td>
                <td>Kedai Makanan</td>
                <td>Kedai Kecil-Menengah</td>
                <td>Kompleks GDC Blok A15</td>
                <td>DEPOK</td>
                <td>AKTIF</td>
            </tr>
            <tr>
                <td>3</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Waring Pecel</td>
                <td>Kedai Makanan</td>
                <td>Kedai Kecil-Menengah</td>
                <td>Fresh Market Kota Wisata</td>
                <td>BOGOR</td>
                <td>AKTIF</td>
            </tr>
            <tr>
                <td>3</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>TEST</td>
                <td>Kedai Makanan</td>
                <td>Restoran</td>
                <td>TEST</td>
                <td>JAKARTA SELATAN</td>
                <td>AKTIF</td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection

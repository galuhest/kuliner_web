@extends('adminlte::page')

@section('htmlheader_title')
	Transaksi
@endsection

@section('contentheader_title')
     Transaksi
@endsection

@section('main-content')
<div class="row">
  <div class="col-xs-12">
    <form>
      <div class="row">
        <div class="col-md-3 form-group">
          <label for="wilayah">Wilayah</label>
          <select class="form-control">
            <option>Semua Wilayah</option>
            <option>Jakarta</option>
            <option>Bekasi</option>
            <option>Bogor</option>
            <option>Depok</option>
          </select>
        </div>

        <div class="col-md-3 form-group">
          <label for="wilayah">Kawasan</label>
          <select class="form-control">
            <option>Semua Kawasan</option>
          </select>
        </div>

        <div class="col-md-3 form-group">
          <label for="wilayah">Area</label>
          <select class="form-control">
            <option>All Area</option>
          </select>
        </div>

        <div class="col-md-3 form-group">
          <label for="wilayah">Kedai</label>
          <select class="form-control">
            <option>All Kedai</option>
            <option>Halalmart</option>
            <option>Warung Pecel</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 form-group">
          <label for="wilayah">Periode</label>
          <select class="form-control">
            <option>Tanggal</option>
            <option>Bulan</option>
          </select>
        </div>

        <div class="col-md-3 form-group">
          <label for="wilayah">Awal</label>
          <input class="form-control" />
        </div>

        <div class="col-md-3 form-group">
          <label for="wilayah">Akhir</label>
          <input class="form-control" />
        </div>

        <div class="row">
          <div class="col-md-3 pull-right" style="padding-top:1.5em;">
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
                <th>Wilayah</th>
                <th>Kawasan</th>
                <th>Area</th>
                <th>Kedai</th>
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Jumlah Pelanggan</th>
                <th>Jumlah Item</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Biaya Kirim</th>
                <th>Infaq</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Jabodetabek</td>
                <td>Cibubur</td>
                <td>Kota Wisata</td>
                <td>Halalmart</td>
                <td>Kota Wisata Cibubur, Bogor</td>
                <td>14-02-2017</td>
                <td>1</td>
                <td>3</td>
                <td>100.000</td>
                <td>0</td>
                <td>0</td>
                <td>25.000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jabodetabek</td>
                <td>Cibubur</td>
                <td>Kota Wisata</td>
                <td>Halalmart</td>
                <td>Kota Wisata Cibubur, Bogor</td>
                <td>16-02-2017</td>
                <td>3</td>
                <td>10</td>
                <td>390.000</td>
                <td>0</td>
                <td>0</td>
                <td>100.000</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Jabodetabek</td>
                <td>Cibubur</td>
                <td>Kota Wisata</td>
                <td>Halalmart</td>
                <td>Kota Wisata Cibubur, Bogor</td>
                <td>19-02-2017</td>
                <td>5</td>
                <td>2</td>
                <td>139.000</td>
                <td>0</td>
                <td>0</td>
                <td>19.000</td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection

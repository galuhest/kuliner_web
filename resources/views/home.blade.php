@extends('adminlte::page')

@section('htmlheader_title')
	Home
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

        <div class="row">
          <div class="col-md-3 pull-right" style="padding-top:1.5em;">
            <a type="submit" class="btn btn-primary">Search</a>
          </div>
        </div>
      </div>
    </form>

    <div class="map">
    <iframe width="100%" height="500px" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/view?zoom=11&center=-6.1745%2C106.8227&key= AIzaSyBnW0n0cisqZhGWKjzfhKw_2ETgp53IXno " allowfullscreen></iframe> 
    </div>

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kedai</th>
                <th>Tipe Kedai</th>
                <th>Is Favorite</th>
                <th>Alamat</th>
                <th>No Telepon</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Halalmart</td>
                <td>Toko</td>
                <td>Ya</td>
                <td>Kota Wisata Cibubur, Bogor</td>
                <td>02182343138</td>
            </tr>
            <tr>
				<td>2</td>
                <td>Bakso Bakar</td>
                <td>Kedai Makanan</td>
                <td>Tidak</td>
                <td>Jalan. Alternatif Cibubur KM 22.5, Bogor</td>
                <td>028392883</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Warung Pecel Budi</td>
                <td>Kedai Makanan</td>
                <td>Ya</td>
                <td>Kota Wisata Cibubur, Bogor</td>
                <td>02193829</td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection

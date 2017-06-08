@extends('adminlte::page')

@section('htmlheader_title')
	 Delivery Tracking
@endsection

@section('contentheader_title')
     Delivery Tracking
@endsection

@section('main-content')
<div class="row">
  <div class="col-xs-12">
    <div class="filter">
      <form>
        <div class="col-md-3 form-group">
          <label for="wilayah">Kedai</label>
          <select class="form-control">
            <option value="1">Halalmart</option>
            <option value="2">Bakso Bakar</option>
            <option value="3">Warung Pecel</option>
          </select>
        </div>

        <div class="col-md-3 form-group">
          <label for="wilayah">Pengantar</label>
          <select class="form-control">
            <option value="1">Pengantar01</option>
            <option value="2">Pengantar02</option>
            <option value="3">Pengantar03</option>
          </select>
        </div>

        <div class="col-md-3 form-group">
          <label for="date">Tanggal</label>
          <input class="form-control">
        </div>

        <div class="col-md-3 form-group">
          <div style="padding-top:1.5em">
            <a type="submit" class="btn btn-primary">Track</a>
          </div>
        </div>
      </form>
    </div>

    <div class="map">
    <iframe width="100%" height="600px" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/view?zoom=11&center=-6.1745%2C106.8227&key= AIzaSyBnW0n0cisqZhGWKjzfhKw_2ETgp53IXno " allowfullscreen></iframe>
    </div>
  </div>
</div>
@endsection

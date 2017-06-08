@extends('adminlte::page')

@section('htmlheader_title')
  Detail Transaksi
@endsection

@section('contentheader_title')
     Detail Transaksi
@endsection

@section('main-content')
<div class="row">
  <div class="col-xs-12">
    <form>
      <div class="row">
        <div class="col-md-3 form-group">
          <label for="wilayah">Kedai</label>
          <select id="outlet" name="outlet" class="form-control">
            <option value="">All Kedai</option>
            @foreach ($outlets as $outlet)
              <option {{ $request->outlet == $outlet->id ? 'selected' : '' }} value="{{ $outlet->id }}">{{ $outlet->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-3 form-group">
          <label for="start_date">Awal</label>
          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="datepicker form-control" name="start_date" id="start_date" value="{{ $request->start_date }}" />
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 form-group">
          <label for="end_date">Akhir</label>
          <label for="start_date">Awal</label>
          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="datepicker form-control" name="end_date" id="end_date" value="{{ $request->end_date }}" />
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
        </div>

        <div class="col-md-3" style="padding-top:1.5em;">
          <button type="submit" class="btn btn-primary">Filter</button>
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
                <th>Nama Pelanggan</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            @foreach($order->details as $detail)
              <tr>
                <td>1</td>
                <td>{{ $order->outlet->area->district->region->name }}</td>
                <td>{{ $order->outlet->area->district->name }}</td>
                <td>{{ $order->outlet->area->name }}</td>
                <td>{{ $order->outlet->name }}</td>
                <td>{{ $order->outlet->address }}</td>
                <td>{{ $order->date }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <?php $price = $detail->getCurrentPrice() ?>
                <td>{{ $price }}</td>
                <td>{{ $detail->quantity * $price }}</td>
              </tr>
            @endforeach
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection

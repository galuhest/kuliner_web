@extends('adminlte::page')

@section('htmlheader_title')
    Management Member
@endsection

@section('contentheader_title')
     Management Member
@endsection

@section('main-content')
<div class="row">
  <div class="col-xs-12">
  <h4 style="margin-bottom: 0em;padding-bottom: 0em">Kriteria</h4>
    <form action="{{ route('management.member') }}" method="GET">
      <div class="row">
        <div class="col-md-4 form-group">
          <label for="wilayah"></label>
          <select id="criteria" name="criteria" class="form-control">
            <option value="member_activation_code">KODE AKTIVASI</option>
            <option value="email">USERNAME</option>
            <option value="name">NAMA</option>
            <option value="created_at">WAKTU AKTIVASI</option>
          </select>
        </div>

        <div class="col-md-4 form-group">
          <label for="wilayah"></label>
          <input type="text" class="form-control" placeholder="query" id="keywords" name="keywords">
        </div>

        <div class="row">
          <div class="col-md-4 pull-right" style="padding-top:1.5em;">
            <button type="submit" class="btn btn-primary">Filter</button>
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
                <th>Aktivasi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $k => $user)
            <tr>
                <td>{{ $k+1 }}</td>
                <td><a>Edit Registrasi</a></td>
                <td>{{ $user->member_activation_code }}</td>
                <td>{{ $user->isActivated() }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->created_at }}</td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection

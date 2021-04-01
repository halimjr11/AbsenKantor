@extends('app.main')
@section('title', 'Rekap Absensi')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong><h1>Rekap Absensi Pegawai</h1></strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No. </th>
                                    <th scope="col">Pegawai</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->name}}</td>
                                        <td><a href="{{route('app.absensi.rekap.detail', $d->id)}}" class="btn btn-info"><i class="fas fa-info"></i> Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
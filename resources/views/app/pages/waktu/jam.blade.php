@extends('app.main')
@section('title', 'Waktu Absen')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong><h1>Manajemen Waktu</h1></strong>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                            <div class="alert alert-success alert-block">
                                {{ session('status') }}
                                <button type="button" class="close float-right" data-dismiss="alert">×</button>
                            </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Batas Akhir</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($waktu as $item)
                        <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->mulai }}</td>
                                <td>{{ $item->batas }}</td>
                                <td>
                                <a href="{{ route('app.editwaktu', $item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Update!</a>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
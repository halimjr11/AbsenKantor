@extends('app.main')
@section('title', 'Cuti')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <strong><h3>Pengajuan Cuti</h3></strong>
                        </div>
                        @if(Auth::user()->level == 'karyawan')
                        <div class="pull-right">
                            <a href="{{route('app.pengajuan.cuti.add')}}" class="btn btn-success btn-sm float-right" > 
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                @if(Auth::user()->level == 'admin'|| Auth::user()->level == 'manajer')
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal awal</th>
                                        <th scope="col">Tanggal akhir</th>
                                        <th scope="col">Status</th>
                                        @if(Auth::user()->level == 'admin')
                                            <th scope="col">Aksi</th>
                                        @endif
                                    </tr>
                                @elseif(Auth::user()->level == 'karyawan')
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal awal</th>
                                        <th scope="col">Tanggal akhir</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                @if(Auth::user()->level == 'admin'|| Auth::user()->level == 'manajer')
                                    @foreach ($cutiall as $item)
                                    <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->tgl_awal }}</td>
                                            <td>{{ $item->tgl_akhir }}</td>
                                            <td>{{ $item->status }}</td> 
                                            @if(Auth::user()->level == 'admin')
                                            <td>
                                                <a href="{{route('app.pengajuan.cuti.appr', $item->id_cuti)}}" class="btn btn-success">Detail</a>
                                            </td>
                                            @endif
                                    </tr>
                                    @endforeach
                                @elseif(Auth::user()->level == 'karyawan')
                                    @foreach ($cuti as $item)
                                    <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->tgl_awal }}</td>
                                            <td>{{ $item->tgl_akhir }}</td>
                                            <td>{{ $item->status }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('modal')
@endpush

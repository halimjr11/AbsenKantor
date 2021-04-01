@extends('app.main')
@section('title','Divisi Management')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <strong><h1>Divisi Management</h1></strong>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('app.divisi.create') }}" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-plus"></i> Add
                            </a>
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
                                    <th scope="col">Nama Divisi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($divisi as $item)
                                <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                        <a href="{{ route('app.divisi.edit', $item->id_divisi ) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Update!</a>
                                        <form action="{{ route('app.divisi.delete', $item->id_divisi ) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i>
                                             Delete
                                            </button>
                                        </form>
                                        </td>
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

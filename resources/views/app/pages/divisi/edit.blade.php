@extends('app.main')
@section('title', 'Edit Data Divisi')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <strong><h1>Edit Divisi</h1></strong>
        </div>
        <div class="card-body">
        <form action="{{ route('app.divisi.edit', $edit->id_divisi) }}" method="post">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="nama">Nama Divisi : </label>
                <input type="text" class="form-control {{$errors->has('nama') ? 'is-invalid' :'' }}" value="{{ $edit->nama }}" name="nama" id="nama" placeholder="Nama Divisi">
                @if($errors->has('nama'))
                    <div class="invalid-feedback">{{$errors->first('nama')}}</div>
                @endif
            </div>
            <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Update!</button>
        </form>
        </div>
    </div>
</div>
@endsection

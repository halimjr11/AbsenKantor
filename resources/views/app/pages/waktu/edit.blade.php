@extends('app.main')
@section('title', 'Edit Waktu Absen')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong><h1>Edit Waktu</h1></strong>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ route('app.editwaktu', $edit->id) }}" method="POST">
                            @method('patch')
                            @csrf
                                <div class="form-group">
                                    <label for="update-desc">Keterangan :</label>
                                <input class="form-control" type="text" name="ket" value="{{ $edit->keterangan }}" id="update-desc" placeholder="Jam Selesai">
                                </div>
                                <div class="form-group">
                                    <label for="update-start">Jam mulai Absensi :</label>
                                    <input class="form-control" type="time" name="mulai" value="{{ $edit->mulai }}" id="update-start" placeholder="Jam Dimulai" required>
                                </div>
                                <div class="form-group">
                                    <label for="update-done">Jam Selesai Absensi :</label>
                                    <input class="form-control" type="time" name="batas" id="update-done" value="{{ $edit->batas }}" placeholder="Jam Selesai" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                    <button class="btn btn-secondary" type="button"><i class="fas fa-times"></i> Kembali</button>
                                </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
@extends('app.main')
@section('title', 'Rekap Absensi')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            <strong>Tambah Berita</strong>
                        </h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="jdl">Judul Berita</label>
                                <input class="form-control" type="text" name="judul" id="jdl">
                            </div>
                            <div class="form-group">
                                <label for="desk">Isi</label>
                                <textarea class="form-control" name="desc" id="desk" cols="30" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary right" type="submit"><i class="fas fa-save"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
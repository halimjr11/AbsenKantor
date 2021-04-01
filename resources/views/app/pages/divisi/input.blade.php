@extends('app.main')
@section('title','Input Divisi')
@section('content')
    <div class="container">
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <strong>Tambah Data Divisi</strong>
                        </div>
                        <div class="pull-right">
                            <a href="" class="btn btn-secondary btn-sm float-right"> 
                                <i class="fa fa-undo"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <form action="" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Nama Divisi</label>
                                        <input type="text" name="nama" class="form-control" autofocus required>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
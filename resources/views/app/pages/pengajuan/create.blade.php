@extends('app.main')
@section('title', 'Pengajuan Cuti')
@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <strong><h1>Tambah Pengajuan</h1></strong>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('app.pengajuan.cuti.add') }}" role="form" id="form-action">
                      @csrf
                      <div class="row">
                        <div class="col-md-6">
                          <label class="control-label">
                            <span class="control-label">Tanggal Mulai</span>
                          </label>
                          <div>
                            <input class="form-control" type="date" name="tgl_awal" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label class="control-label">
                            <span>Tanggal Selesai</span>
                          </label>
                          <div>
                            <input class="form-control" type="date" name="tgl_akhir" required>
                          </div>
                        </div>
                      </div>
                      <div div class="form-group">
                        <label class="control-label">
                          Sisa cuti</span>
                        </label>
                        <div class="alert alert-primary" role="alert">
                          {{$data->jumlah}}
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label>Keterangan Cuti <span class="symbol required"> </span></label>
                        <textarea class="form-control" name="alasan" placeholder="Enter ..."></textarea>
                      </div>
                      
                      <div class="form-group justify-content-between">
                        <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                      </div>
                </form>
        </div>
    </div>
</div>
@endsection
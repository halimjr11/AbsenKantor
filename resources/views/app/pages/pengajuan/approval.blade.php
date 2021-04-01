@extends('app.main')
@section('title', 'Cuti')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Approval Pengajuan Cuti</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('app.pengajuan.cuti.appr', $data->id_cuti) }}" method="post">
                            @method('patch')
                            @csrf
                            <input class="form-control" name="user" type="text" value="{{$data->id}}" hidden>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input class="form-control" type="text" id="name" value="{{$data->name}}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl1">Tanggal Mulai</label>
                                        <input type="text" name="tgl_Awal" id="tgl1" class="form-control bg-info text-white" value="{{$data->tgl_awal}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl2">Tanggal Selesai</label>
                                        <input type="text" name="tgl_Akhir" id="tgl2" class="form-control bg-info text-white" value="{{$data->tgl_akhir}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Jumlah</label>
                                <input class="form-control bg-success text-white" name="jumlah" type="text" id="name" value="{{$data->jumlah_cuti}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="appr">Tanggapan</label>
                                <select name="approve" id="appr" class="form-control">
                                    <option class="bg-success text-white" value="Y">Setujui</option>
                                    <option class="bg-danger text-white" value="N">Tolak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan</label>
                                <textarea class="form-control" name="alasan" id="alasan" cols="30" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Kirim Tanggapan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
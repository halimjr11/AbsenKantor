@extends('app.main')
@section('title', 'Data Pegawai')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <strong><h1>Data Pegawai</h1></strong>
            </div>
            <div class="pull-right">
                <a href="{{ route('app.pegawai.create') }}" class="btn btn-success btn-sm float-right"> 
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
                        <th scope="col">Nama</th>
                        <th scope="col">Divisi</th>
                        <th scope="col">Level</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (Auth::user()->level == "admin")
                        @foreach($user as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->nama }}</td>
                            <td>{{ $u->level }}</td>
                            <td>
                                <a href="#" id="detail" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailPegawai"
                                data-id="{{$u->id}}"
                                data-nama="{{$u->name}}"
                                data-email="{{$u->email}}"
                                data-jk="{{$u->jk}}"
                                data-telp="{{$u->telp}}"
                                data-alamat="{{$u->alamat}}"
                                data-level="{{$u->level}}"><i class="fas fa-info"></i> Detail</a>
                            <a href="{{ route('app.pegawai.edit', $u->id)}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Update!</a>
                            <a href="{{ route('app.pegawai.delete', $u->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Delete</a>

                            </td>
                        </tr>
                        @endforeach
                    @else
                        @foreach($user2 as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->nama }}</td>
                            <td>{{ $u->level }}</td>
                            <td>
                                <a href="#" id="detail" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailPegawai"
                                data-id="{{$u->id}}"
                                data-nama="{{$u->name}}"
                                data-email="{{$u->email}}"
                                data-jk="{{$u->jk}}"
                                data-telp="{{$u->telp}}"
                                data-alamat="{{$u->alamat}}"
                                data-level="{{$u->level}}"><i class="fas fa-info"></i> Detail</a>
                            <a href="{{ route('app.pegawai.edit', $u->id)}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Update!</a>
                            <form action="{{ route('app.pegawai.delete', $u->id ) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i>
                                 Delete
                                </button>
                            </form>

                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('modal')
<div class="modal" id="detailPegawai" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-recom">
          <h5 class="modal-title text-white">Detail Pegawai</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered text-gray">
              <tbody>
                  <tr>
                      <th>Id</th>
                      <td><span id="id"></span></td>
                  </tr>
                  <tr>
                      <th>Nama</th>
                      <td><span id="nama"></span></td>
                  </tr>
                  <tr>
                      <th>Jenis Kelamin</th>
                      <td><span id="jk"></span></td>
                  </tr>
                  <tr>
                      <th>Email</th>
                      <td><span id="email"></span></td>
                 </tr>
                  <tr>
                      <th>No. Telp</th>
                      <td><span id="telp"></span></td>
                 </tr>
                  <tr>
                      <th>Alamat</th>
                      <td><span id="alamat"></span></td>
                 </tr>
                  <tr>
                      <th>Level</th>
                      <td><span id="level"></span></td>
                  </tr>
              </tbody>
          </table>
        </div>
        <div class="modal-footer bg-recom">
          <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endpush
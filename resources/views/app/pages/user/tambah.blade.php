@extends('app.main')
@section('title', 'Tambah Data Pegawai')
@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong><h1>Tambah Data Pegawai</h1></strong>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('app.pegawai.create')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Name</label>  
                        <input type="text" name="name" 
                        class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
                        id="nama" placeholder="Name" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" 
                        class="form-control {{$errors->has('email') ? 'is-invalid' :'' }}"
                        id="email" placeholder="Email" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">{{$errors->first('email')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="JK">Jenis Kelamin</label>
                        <select
                        class="form-control {{$errors->has('jk') ? 'is-invalid' :'' }}"
                        name="jk" id="JK">
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                        </select>
                        @if($errors->has('jk'))
                            <div class="invalid-feedback">{{$errors->first('jk')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="loc">Alamat</label>
                        <input type="text" name="alamat" 
                        class="form-control {{$errors->has('alamat') ? 'is-invalid' :'' }}"
                        id="loc" placeholder="Alamat" required>
                        @if($errors->has('alamat'))
                            <div class="invalid-feedback">{{$errors->first('alamat')}}</div>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="Contact">Telp</label>
                        <input type="text" name="telp" 
                        class="form-control {{$errors->has('telp') ? 'is-invalid' :'' }}"
                        id="Contact" placeholder="Telp" required>
                        @if($errors->has('telp'))
                            <div class="invalid-feedback">{{$errors->first('telp')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Div">Divisi</label>
                        <select
                        class="form-control {{$errors->has('divisi') ? 'is-invalid' :'' }}"
                        name="divisi" id="Div">
                                <option value="">---pilih divisi---</option>
                                @foreach($divisi as $d)
                                <option value="{{ $d->id_divisi }}">{{ $d->nama }}</option>
                                @endforeach
                        </select>
                        @if($errors->has('divisi'))
                            <div class="invalid-feedback">{{$errors->first('divisi')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" 
                        class="form-control {{$errors->has('divisi') ? 'is-invalid' :'' }}"
                        id="password" placeholder="Password">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">{{$errors->first('password')}}</div>
                        @endif
                        <small>bila tidak ingin diganti kosongkan saja password.</small>
                    </div>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-save"></i>
                        Simpan Data Pegawai
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
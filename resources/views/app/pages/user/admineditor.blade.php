@extends('app.main')
@section('title', 'Edit Data Pegawai')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong><h1>Perbarui Data Pegawai</h1></strong>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('app.pegawai.edit', $edit->id)}}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="nama">Name</label>
                        <input type="text" name="name"
                        class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
                        id="nama" placeholder="Name" value="{{$edit->name}}" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email"
                        class="form-control {{$errors->has('email') ? 'is-invalid' :'' }}"
                        id="email" placeholder="Email" value="{{$edit->email}}" required>
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
                        id="loc" placeholder="Alamat" value="{{$edit->alamat}}" required>
                        @if($errors->has('alamat'))
                            <div class="invalid-feedback">{{$errors->first('alamat')}}</div>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="Contact">Telp</label>
                        <input type="text" name="telp"
                        class="form-control {{$errors->has('telp') ? 'is-invalid' :'' }}"
                        id="Contact" placeholder="Telp" value="{{$edit->telp}}" required>
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
                        <label for="lv">Level</label>
                        <select
                        class="form-control {{$errors->has('level') ? 'is-invalid' :'' }}"
                        name="level" id="lv">
                                <option value="admin">Admin</option>
                                <option value="manajer">Manajer</option>
                                <option value="karyawan">Karyawan</option>
                        </select>
                        @if($errors->has('level'))
                            <div class="invalid-feedback">{{$errors->first('level')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="notif">Notifikasi</label>
                        <select
                        class="form-control {{$errors->has('notif') ? 'is-invalid' :'' }}"
                        name="notif" id="notif">
                                <option value="1">1</option>
                                <option value="0">0</option>
                        </select>
                        @if($errors->has('notif'))
                            <div class="invalid-feedback">{{$errors->first('notif')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password"
                        class="form-control {{$errors->has('password') ? 'is-invalid' :'' }}"
                        id="password" placeholder="Password" required>
                        @if($errors->has('password'))
                            <div class="invalid-feedback">{{$errors->first('password')}}</div>
                        @endif
                    </div>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-save"></i>
                        Save & Update
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('app.main')
@section('title', 'User Setting')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
            <strong><h1>User Profile & Setting</h1></strong>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    @if (session('status'))
                            <div class="alert alert-success alert-block">
                                {{ session('status') }}
                                <button type="button" class="close float-right" data-dismiss="alert">×</button>
                            </div>
                    @endif
                    <div class="card">
                        <form method="POST" action="{{ route('app.user.profile', Auth::user()->id) }}">
                            <div class="card mb-3">
                                <div class="card-header bg-secondary"><h5>Pengaturan akun pengguna</h5></div> 
                                <div class="card-body">
                                    {{ csrf_field()}}
                                    @method('patch')

                                    <div class="form-group">
                                        <label for="nama">Nama</label>  
                                        <input type="text" name="name" 
                                        class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
                                        value="{{ old('name',$dt->name) }}"
                                        id="nama" placeholder="Name" required>
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" 
                                        class="form-control {{$errors->has('email') ? 'is-invalid' :'' }}"
                                        value="{{ old('email',$dt->email) }}"
                                        id="email" placeholder="Email" required>
                                        @if($errors->has('email'))
                                            <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="JK">Jenis Kelamin</label>
                                        <select
                                        class="form-control {{$errors->has('jk') ? 'is-invalid' :'' }}"
                                        name="jk" id="JK"
                                        value="{{old('jk', $dt->jk)}}" <?= ($dt->jk == Auth::user()->jk) ? 'selected' : ''?>>
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
                                        value="{{ old('telp',$dt->alamat) }}"
                                        id="loc" placeholder="Alamat" required>
                                        @if($errors->has('alamat'))
                                            <div class="invalid-feedback">{{$errors->first('alamat')}}</div>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="Contact">Telp</label>
                                        <input type="text" name="telp" 
                                        class="form-control {{$errors->has('telp') ? 'is-invalid' :'' }}"
                                        value="{{ old('telp',$dt->telp) }}"
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
                                        <label for="password">Katasandi</label>
                                        <input type="text" name="password" 
                                        class="form-control {{$errors->has('password') ? 'is-invalid' :'' }}"
                                        value=""
                                        id="password" placeholder="Password" required>
                                        @if($errors->has('password'))
                                            <div class="invalid-feedback">{{$errors->first('password')}}</div>
                                        @endif
                                        <div class="form-text text-muted">
                                            <small>Kosongkan Password apabila tidak diubah.</small>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-save"></i>
                                        Ubah
                                    </button>
                                </div>           
                            </div>
                        </form>   
                    </div> 
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-secondary"><h5>Profil Pengguna</h5></div>
                            <div class="card-body">
                                <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ url('images/logo.png') }}"
                                        alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                                    <p class="text-muted text-center">Manajer Proyek</p>
                                <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- About Me Box -->
                                <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fas fa-transgender"></i> Jenis Kelamin</strong>

                                    <p class="text-muted">
                                        {{Auth::user()->jk}}
                                    </p>

                                    <hr>

                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                                    <p class="text-muted">{{Auth::user()->alamat}}</p>


                                    <hr>

                                    <strong><i class="fas fa-envelope"></i> Email</strong>

                                    <p class="text-muted">{{Auth::user()->email}}</p>

                                    <hr>

                                    <strong><i class="fas fa-id-badge"></i> Divisi</strong>

                                    <p class="text-muted">{{ $dt->nama }}</p></p>
                                </div>
                                <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
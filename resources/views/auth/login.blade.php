@extends('auth.main')
@section('title', 'Login')
@section('content')
    <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('login') }}">
                                        {{csrf_field()}}
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4 {{$errors->has('email') ? 'is-invalid' :'' }}" id="inputEmailAddress" name="email" type="email" placeholder="Enter email address" required/>
                                                @if($errors->has('email'))
                                                <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4 {{$errors->has('password') ? 'is-invalid' :'' }}" id="inputPassword" name="password"  type="password" placeholder="Enter password" />
                                                @if($errors->has('password'))
                                                <div class="invalid-feedback">{{$errors->first('password')}}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" name="remember"/>
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="{{route('password.request') }}">Forgot Password?</a>
                                            </div>
                                            <button class="btn btn-primary btn-block" type="submit">Login</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection
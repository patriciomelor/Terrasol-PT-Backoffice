@extends('layouts.app')

@section('content')

                <div class="card-header text-center">
                    <a href="#" class="h1"><b>{{ __('Login') }}</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Complete los datos para ingresar</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus placeholder="{{ __('Email Address') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="{{ __('Password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-8 text-right">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        {{ __('Recuérdame') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-info btn-block">{{ __('Ingresar') }}</button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <p class="mb-1">
                            <a href="{{ route('password.request') }}">{{ __('Olvidé la contraseña?') }}</a>
                        </p>
                        <p class="mb-0">
                            <a href="{{ route('register') }}" class="text-center">{{ __('Registrarme') }}</a>
                        </p>
                    </div>
                </div>
 
@endsection

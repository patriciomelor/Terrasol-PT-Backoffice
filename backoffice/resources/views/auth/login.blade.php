@extends('layouts.app')

@section('content')
   

            <!-- Login Form -->
            <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-12 pt-5">
                    <h4 class="mb-1">Bienvenido a Terrasol! 👋</h4>
                    <p class="mb-6">Porfavor, Ingresa tus credenciales</p>

                    <form id="formAuthentication" class="mb-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-6 fv-plugins-icon-container">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-6 form-password-toggle fv-plugins-icon-container">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge has-validation">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="············" required>
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="my-8">
                            <div class="d-flex justify-content-between">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember-me">Recuerdame!</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="mb-0">Olvido su contraseña?</a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">Ingresar</button>
                    </form>

                    {{-- <p class="text-center mt-3">
                        <span>Nuevo en la plataforma?</span>
                        <a href="{{ route('register') }}">
                            <span>Crear Cuenta</span>
                        </a>
                    </p> --}}
                </div>
            </div>
    

   
@endsection

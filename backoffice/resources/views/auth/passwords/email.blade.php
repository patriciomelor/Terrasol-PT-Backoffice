@extends('layouts.app')

@section('content')
            <!-- Login Form -->
            <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-12 pt-5">
                    <h4 class="mb-1">Bienvenido a Terrasol! 👋</h4>
                    <p class="mb-6">Porfavor, Ingresa tus Correo</p>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="mb-6" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class=" fv-plugins-icon-container  mb-3">
                               <div class="col-md-12">
                                <label for="email" class="form-label">Ingrese Su Correo</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo@correo.cl" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">
                                    Enviar Link de Restablecimiento de Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
@endsection

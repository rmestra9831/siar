@extends('layouts.extructure')
@section('title','Login')
@section('main')
    <div class="ui column centered grid">
        <form class="ui form" method="POST" action="{{ route('login') }}">
            @csrf
            <h3 class="ui dividing header">Iniciar Sesión</h3>
            <div class="field">
                <div class="ui large left icon input fluid">
                    <input id="email" type="email" class="form-control bg-input-login @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo de usuario">
                    <i class="user circle outline icon"></i>
                    {{-- @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                </div>
            </div>

            <div class="field">
                <div class="ui large left icon input fluid">
                    <input id="password" type="password" class="form-control bg-input-login @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                    <i class="terminal icon"></i>
                    {{-- @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                </div>
            </div>

            <div class="inline field">
                <div class="ui toggle checkbox">
                    <input class="hidden" type="checkbox" name="remember" tabindex="0" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Recuerdame') }}
                    </label>
                </div>
            </div>
            <div class="inline field">
                <div class="">
                    <button type="submit" class="positive fluid ui button">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content_body')
    <div id="login_body">     
        <h2><img src="{{ asset('img\logo.png') }}" alt=""> SIC</h2>
        <h6><div class="bar"></div> Sistema de Información Admisiones y Registro</h6>   
    </div>
@endsection

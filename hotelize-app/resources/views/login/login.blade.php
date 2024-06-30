@extends('layouts.externo')

@push('titulo', 'Login - Hotelize')

@section('content')
    <h1>Login</h1>
    <form action="{{ route('autenticar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" value="{{old('email')}}" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <div class="password-container">
                <input type="password" class="form-control" placeholder="Digite sua senha" name="password" id="password"
                    required>
                <i class="fa-solid fa-eye" id="eye"></i>
            </div>
        </div>
        <hr>
        <button type="submit">Entrar</button>
    </form>
    <div class="mb-3">
        <a class="forgot-password" href="{{ route('users.create') }}">Não possui uma conta? Cadastre-se</a>
    </div>
@endsection

@section('script')
@endsection

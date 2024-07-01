@extends('layouts.externo')

@push('titulo', 'Registrar-se - Hotelize')

@section('content')
    <h1>Registrar-se</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-1">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo"
                value="{{ old('name') }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail"
                value="{{ old('email') }}" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="senha" class="form-label">Senha</label>
            <div class="password-container">
                <input type="password" class="form-control" placeholder="Digite sua senha" name="password" id="password"
                    required>
                <i class="fa-solid fa-eye" id="eye"></i>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1">
            <label for="senha" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" placeholder="Digite a senha novamente" name="password_confirmation"
                id="password_confirmation" required>
        </div>
        <hr>
        <button type="submit">Registrar</button>
    </form>
    <div class="mb-1">
        <a class="forgot-password" href="{{ route('login') }}">Já possui uma conta? Faça login</a>
    </div>
@endsection

@push('script')
    <script>
        // Função para garantir que a senha e a confirmação de senha sejam iguais
        $(document).ready(function() {
            $('#password, #password_confirmation').on('keyup', function() {
                console.log($('#password').val(), $('#password_confirmation').val());
                if ($('#password').val() == $('#password_confirmation').val()) {
                    $('#password').css('border-color', 'green');
                    $('#password_confirmation').css('border-color', 'green');
                } else {
                    $('#password').css('border-color', 'red');
                    $('#password_confirmation').css('border-color', 'red');
                }
            });
        });
    </script>
@endpush

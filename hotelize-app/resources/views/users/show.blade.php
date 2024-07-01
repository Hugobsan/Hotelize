@extends('layouts.interno')

@push('titulo', 'Hotelize - Perfil')

@section('content')

    <div class="topo d-flex flex-row justify-content-between">
        <div>
            <h1>Informações do usuário</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nome:</strong> <span id="name">{{ $user->name }}</span></p>
                    <p><strong>E-mail:</strong> <span id="email">{{ $user->email }}</span></p>
                    <p><strong>Data de cadastro:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        //Ao clicar no nome transforma em input
        $('#name').click(function() {
            var name = $(this).text();
            $(this).html('<input type="text" value="' + name + '" />');
            $(this).find('input').focus();

            $(this).find('input').blur(function() {
                var name = $(this).val();
                var csrf = '{{csrf_token()}}';
                //Requisição AJAX para atualizar o nome e cria uma mensagem de sucesso
                $.ajax({
                    url: '{{ route('users.update', $user->id) }}',
                    type: 'POST',
                    data: {
                        name: name,
                        _token: csrf,
                        _method: 'PUT'
                    }
                }).done(function() {
                    alert('Nome atualizado com sucesso');
                });

                $(this).parent().text(name);
            });
        });

        //Ao clicar no e-mail transforma em input
        $('#email').click(function() {
            var email = $(this).text();
            $(this).html('<input type="text" value="' + email + '" />');
            $(this).find('input').focus();

            $(this).find('input').blur(function() {
                var email = $(this).val();
                var csrf = '{{csrf_token()}}';
                //Requisição AJAX para atualizar o e-mail e cria uma mensagem de sucesso
                $.ajax({
                    url: '{{ route('users.update', $user->id) }}',
                    type: 'POST',
                    data: {
                        email: email,
                        _token: csrf,
                        _method: 'PUT'
                    }
                }).done(function() {
                    alert('E-mail atualizado com sucesso');
                });

                $(this).parent().text(email);
            });
        });
    </script>
@endpush

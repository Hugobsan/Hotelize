@extends('layouts.interno')

@push('titulo', 'Hotelize - Usuários')

@section('content')
    <div class="topo d-flex flex-row justify-content-between">
        <div>
            <h1>Usuários</h1>
        </div>
    </div>
     <!-- Modal -->
     {{-- @include('hotels.components.create') --}}
    <div class="tabela table-responsive" style="overflow-x:hidden">
        <table class="table table-striped data-table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Data de cadastro</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhum usuário cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    <script>
    </script>
@endpush

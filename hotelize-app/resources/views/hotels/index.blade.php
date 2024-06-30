@extends('layouts.interno')

@section('titulo', 'Hotelize - Hoteis')

@section('content')
    <div class="topo d-flex flex-row justify-content-between">
        <div>
            <h1>Hotéis</h1>
        </div>

        <div>
            <button type="button" class="btn-new" data-bs-toggle="modal" data-bs-target="#CreateHotel">
                <i class="fas fa-plus"></i> Novo Hotel
            </button>
        </div>
    </div>
     <!-- Modal -->
     @include('hotels.components.create')
    <div class="tabela table-responsive" style="overflow-x:hidden">
        <table class="table table-striped data-table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Quant. Quartos</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hotels as $hotel)
                    <tr>
                        <td>{{ $hotel->name }}</td>
                        <td>{{ $hotel->full_address }}</td>
                        <td>{{ $hotel->zip_code }}</td>
                        <td>{{ $hotel->rooms->count() }}</td>
                        <td class="d-flex flex-row justify-between">
                            <a href="{{ route('hotels.show', $hotel->id) }}" class="btn-show">
                                <i class="fas fa-bars-progress" data-bs-toggle="tooltip" title="Detalhes"></i>
                            </a>
                            @if ($hotel->website)
                                <a href="{{ $hotel->website }}" class="btn-show" target="_blank" data-bs-toggle="tooltip" title="Visitar Website">
                                    <i class="fas fa-globe"></i>
                                </a>
                            @endif
                            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" data-bs-toggle="tootlip" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    <script>
        //Abrindo o modal de cadastro caso haja erro de validação ao editar um hotel
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('CreateHotel'));
                myModal.show();
            });
        @endif
    </script>
@endpush

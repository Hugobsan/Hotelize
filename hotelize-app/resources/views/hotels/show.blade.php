@extends('layouts.interno')

@section('titulo', 'Hotelize - ' . $hotel->name)

@section('content')
    <div class="topo">
        <h1>{{ $hotel->name }}</h1>
        <div class="d-flex flex-row justify-between">
            <!-- Modal button -->
            <span>
                <button type="button" class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#CreateHotel">
                    <i class="fas fa-pen-to-square"></i> Editar
                </button>
            </span>

            <!-- Show button -->
            @if ($hotel->website)
                <a href="{{ $hotel->website }}" target="_blank">
                    <button type="button" class="btn btn-primary text-decoration-none m-2">
                        <i class="fas fa-globe"></i> Visitar Website
                    </button>
                </a>
            @endif

            <!-- Delete button -->
            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger m-2">
                    <i class="fas fa-trash"></i> Excluir
                </button>
            </form>
        </div>

    </div>

    <!-- Modal -->
    @include('hotels.components.create')

    <div class="bg-white mx-3 my-2 p-4 rounded">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <p><strong>Endereço:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $hotel->full_address }}</p>
            </div>
            <div class="col-sm-12 col-md-6">
                <p><strong>CEP: </strong></p>
                <p class="border-bottom border-secondary p-2">{{ $hotel->zip_code }}</p>
            </div>
        </div>
    </div>

    <div class="box-historico bg-white mx-3 my-2 rounded h-75">
        <div class="topo d-flex flex-row justify-between child-sticky">
            <div>
                <h1>Quartos</h1>
            </div>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#CreateRoom">
                    <i class="fas fa-plus"></i> Novo Quarto
                </button>
            </div>
        </div>
        @include('hotels.components.create-room')
        @forelse($hotel->rooms as $room)
            <div class="row border border-secondary rounded p-3 m-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $room->name }}</strong>
                    </div>
                    <div>
                        <p>{{ $room->description }}</p>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <span>
                            <button type="button" class="btn btn-warning m-1 edit-room" data-bs-toggle="modal"
                                data-bs-target="#CreateRoom" data-id="{{$room->id}}">
                                <i class="fas fa-pen"></i>
                            </button>
                        </span>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Não há quartos cadastrados neste hotel.</p>
        @endforelse
    </div>
@endsection

@push('script')
    <script>
        //Abrindo o modal caso haja erro de validação e o erro seja de edição
        @if ($errors->any() && !old('hotel_id'))
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('CreateHotel'));
                myModal.show();
            });
        @endif

        //Abrindo o modal de cadastro caso haja erro de validação ao cadastrar um novo quarto
        @if ($errors->any() && old('hotel_id'))
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('CreateRoom'));
                myModal.show();
            });
        @endif

        //Reconfigurando modal de cadastro para função de editar (JQuery)
        $('#CreateHotel').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var title = modal.find('.modal-title');
            var form = modal.find('form');
            var hotel = @json($hotel);

            title.text('Editar Hotel');
            form.attr('action', '/hotels/' + hotel.id);
            form.append('<input type="hidden" name="_method" value="PUT">');

            form.find('#name').val(hotel.name);
            form.find('#zip_code').val(hotel.zip_code);
            form.find('#address').val(hotel.address);
            form.find('#city').val(hotel.city);
            form.find('#state').val(hotel.state);
            form.find('#website').val(hotel.website);

            //Alterando botão Cadastrar para Editar
            form.find('button[type="submit"]').text('Editar');
        });

        //Reconfigurando modal de cadastro de quarto para função de editar (JQuery)
        $('.edit-room').on('click', function() {
            var rooms = @json($hotel->rooms);
            //Pegando o id do quarto
            var id = $(this).data('id');
            //Filtrando o quarto pelo id
            var room = rooms.filter(room => room.id == id)[0];
            var modal = $('#CreateRoom');
            var title = modal.find('.modal-title');
            var form = modal.find('form');

            title.text('Editar Quarto');
            form.attr('action', '/rooms/' + room.id);
            form.append('<input type="hidden" name="_method" value="PUT">');
            
            form.find('#name').val(room.name);
            form.find('#description').val(room.description);
            form.find('#hotel_id').val(room.hotel_id);

            //Alterando botão Cadastrar para Editar
            form.find('button[type="submit"]').text('Editar');
        });
        
    </script>
@endpush

<div class="modal fade" id="CreateHotel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Cadastro de Hotel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('hotels.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Nome do Hotel" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="zip_code">CEP</label>
                                <input type="text" class="form-control" name="zip_code" id="zip_code"
                                    placeholder="CEP" value="{{ old('zip_code') }}" required>
                                @error('zip_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="address">Endereço</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="Endereço" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="city">Cidade</label>
                                <input type="text" class="form-control" name="city" id="city"
                                    placeholder="Cidade" value="{{ old('city') }}" readonly required>
                                @error('city')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <input type="text" class="form-control" name="state" id="state"
                                    placeholder="Estado" value="{{ old('state') }}" readonly required>
                                @error('state')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" name="website" id="website"
                                    placeholder="Website" value="{{ old('website') }}">
                                @error('website')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $('#zip_code').mask('00000-000');
            $('#zip_code').on('blur', function() {
                var cep = $(this).val().replace(/[^0-9]/, '');
                if (cep) {
                    var url = '{{route('api.cep', ['cep' => ''])}}/' + cep;
                    $.ajax({
                        url: url,
                        dataType: 'json',
                        contentType: 'application/json',
                        success: function(data) {
                            $('#city').val(data.localidade);
                            $('#state').val(data.uf);
                        }
                    });
                }
            });
        });
    </script>
@endpush

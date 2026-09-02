<x-layout-guest page-title="Confirmar conta">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-5">

                <!-- logo -->
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>

                <!-- criação da senha -->
                <div class="card p-5">

                    <p>Bem-vindo! Para concluir seu cadastro, defina a sua senha de acesso.</p>

                    <form action="{{ route('confirm-account.store-password', $token) }}" method="post">

                        @csrf

                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary px-4">Definir Senha</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</x-layout-guest>

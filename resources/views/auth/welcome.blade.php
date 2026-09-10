<x-layout-guest page-title="Welcome">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

                {{-- logo --}}
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>

                {{-- welcome message --}}
                <div class="card p-5 text-center">
                    <p>bem-vindo, <strong>{{ $user->name }}</strong>!</p>
                    <p>Sua conta foi criada com sucesso.</p>
                    <p>Você pode agora <a href="{{ route('login') }}">entrar</a> na sua conta.</p>
                </div>

            </div>
        </div>
    </div>

</x-layout-guest>
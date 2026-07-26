<div class="d-flex gap-5">
    <div>
        <i class="fas fa-user me-3"></i>Nome: {{ auth()->user()->name }}
    </div>

    <div>
        <i class="fa-solid fa-screwdriver-wrench me-3"></i>Role: {{ auth()->user()->role }}
    </div>

    <div>
        <i class="fas fa-envelope me-3"></i>Email: {{ auth()->user()->email }}
    </div>

    <div>
        <i class="fas fa-calendar me-3"></i>Data de criação: {{ auth()->user()->created_at->format('d/m/Y') }}
    </div>
</div>

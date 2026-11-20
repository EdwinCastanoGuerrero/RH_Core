<div class="d-flex justify-content-between bg-transparent  border-secondary text-white py-3 px-3">
    
    <!-- logo -->
    <div class="d-flex align-items-center">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="logo" width="100px" class="img-fluid" >
        </a>
        <h4 class="ms-3 m-0 p-0">
            <span class="text-primary">RH</span><span class="text-success">Core</span>
        </h4>
    </div>

    <!-- user -->
    <div class="dropdown d-flex align-items-center">
        <button type="button"
                class="user-identity dropdown-toggle d-flex align-items-center border-0 bg-transparent px-0"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <i class="fas fa-user-circle fa-2x me-2" aria-hidden="true"></i>
            {{ auth()->user()->name }}
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('user.profile') }}">
                    <i class="fas fa-user me-2" aria-hidden="true"></i>User profile
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2" aria-hidden="true"></i>Sair
                    </button>
                </form>
            </li>
        </ul>
    </div>

</div>
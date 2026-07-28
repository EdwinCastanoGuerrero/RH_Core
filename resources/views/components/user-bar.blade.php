<div class="d-flex justify-content-between bg-color-1 text-white py-3 px-3">
    
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
    <div class="d-flex align-items-center">
        <i class="fas fa-user-circle me-3"></i>
        <a href="#" class="text-primary me-3">
            {{ auth()->user()->name }}
        </a>

        {{-- logout --}}
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>

</div>
<x-layout-app page-title="Delete RH User">

    <div class="w-25 p-4">

        <h3>Delete RH User</h3>
    
        <hr>
    
        <p>Are you sure you want to delete this RH user?</p>
        
        <div class="text-center">
            <h3 class="my-5">{{ $user->name }}</h3>
            <a href="{{ route('colaborators.rh-users') }}" class="btn btn-secondary px-5 m-2">No</a>
            <form action="{{ route('colaborators.rh.delete-colaborator', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-5 m-2">Yes</button>
            </form>
        </div>
        
    </div>

</x-layout-app>
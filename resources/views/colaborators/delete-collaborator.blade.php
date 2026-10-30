<x-layout-app page-title="Delete Collaborator">

    <div class="w-25 p-4">

        <h3>Delete Collaborator</h3>
    
        <hr>
    
        <p>Are you sure you want to delete this collaborator?</p>
        
        <div class="text-center">
            <h3 class="my-5">{{ $user->name }}</h3>
            <p>{{ $user->email }}</p>
            <a href="{{ route('rh-management.index') }}" class="btn btn-secondary px-5 m-2">No</a>
            <form action="{{ route('rh-management.destroy-collaborator', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-5 m-2">Yes</button>
            </form>
        </div>
        
    </div>

</x-layout-app>
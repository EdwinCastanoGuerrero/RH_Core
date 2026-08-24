<x-layout-app page-title="Delete RH User">

    <div class="w-25 p-4">

        <h3>Delete RH User</h3>
    
        <hr>
    
        <p>Are you sure you want to delete this RH user?</p>
        
        <div class="text-center">
            <h3 class="my-5">{{ $user->name }}</h3>
            <a href="{{ route('colaborators.rh-users') }}" class="btn btn-secondary px-5 m-2">No</a>
            <a href="{{ route('colaborators.rh.delete-colaborator', $user->id) }}" class="btn btn-danger px-5 m-2">Yes</a>
        </div>
        
    </div>

</x-layout-app>
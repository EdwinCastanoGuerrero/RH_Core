<x-layout-app page-title="Delete department">

    <div class="w-25 p-4">

        <h3>Delete department</h3>
    
        <hr>
    
        <p>Are you sure you want to delete this department?</p>
        
        <div class="text-center">
            <h3 class="my-5">{{ $department->name }}</h3>
            <a href="{{ route('departments') }}" class="btn btn-secondary px-5">No</a>
            <form action="{{ route('department.delete-department-confirm', $department->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-5">Yes</button>
            </form>
        </div>
        
    </div>

</x-layout-app>

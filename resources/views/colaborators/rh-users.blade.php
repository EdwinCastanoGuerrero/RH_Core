<x-layout-app page-title="RH Resources">

    <div class="w-100 p-4">

        <h3>Human Resources Colaborators</h3>

        <hr>

        @if ($users->count() === 0)

            <div class="text-center my-5">
                <p>No human resources collaborators found.</p>
                <a href="{{ route('colaborators.rh.new-colaborator') }}" class="btn btn-primary">Create a new
                    collaborator</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('colaborators.rh.new-colaborator') }}" class="btn btn-primary">Create a new colaborator</a>
            </div>

            <table class="table" id="table">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Active</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Admission date</th>
                        <th>Salary</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @empty($user->email_verified_at)
                                    <span class="badge bg-danger">No</span>
                                @else
                                    <span class="badge bg-success">Yes</span>
                                @endif
                            </td>
                            <td>{{ $user->department->name ?? 'N/A' }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->userDetails->admission_date ?? 'N/A' }}</td>
                            <td>{{ $user->userDetails->salary ?? 'N/A' }} $</td>

                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{ route('colaborators.rh.edit-colaborator', $user->id) }}" class="btn btn-sm btn-outline-dark ms-3"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                    <a href="{{ route('colaborators.rh.delete-colaborator-confirm', $user->id) }}" class="btn btn-sm btn-outline-dark ms-3"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        @endif

    </div>

</x-layout-app>

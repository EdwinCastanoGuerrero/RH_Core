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
                    <tr class="bg-transparent">
                        <th class="bg-transparent text-black">Nome</th>
                        <th class="bg-transparent text-black">Email</th>
                        <th class="bg-transparent text-black">Activo</th>
                        <th class="bg-transparent text-black">Departamento</th>
                        <th class="bg-transparent text-black">Role</th>
                        <th class="bg-transparent text-black">Admissão</th>
                        <th class="bg-transparent text-black">Salário</th>
                        <th class="bg-transparent text-black"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        <tr>
                            <td class="bg-transparent">{{ $user->name }}</td>
                            <td class="bg-transparent">{{ $user->email }}</td>
                            <td class="bg-transparent">
                                @empty($user->email_verified_at)
                                    <span class="badge bg-danger">No</span>
                                @else
                                    <span class="badge bg-success">Yes</span>
                                @endif
                            </td>
                            <td class="bg-transparent">{{ $user->department->name ?? 'N/A' }}</td>
                            <td class="bg-transparent">{{ $user->role }}</td>
                            <td class="bg-transparent">{{ $user->userDetails->admission_date ?? 'N/A' }}</td>
                            <td class="bg-transparent">{{ $user->userDetails->salary ?? 'N/A' }} $</td>

                            <td class="bg-transparent">
                                <div class="d-flex gap-3 justify-content-end">
                                    @empty($user->deleted_at)
                                        <a href="{{ route('colaborators.rh.edit-colaborator', ['id' => $user->id]) }}" class="btn btn-sm btn-outline-primary ms-3"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                        <a href="{{ route('colaborators.rh.delete-colaborator', ['id' => $user->id]) }}" class="btn btn-sm btn-outline-danger ms-3"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
                                    @else
                                        <form action="{{ route('colaborators.rh.restore', ['id' => $user->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success ms-3"><i class="fa-solid fa-trash-arrow-up me-2"></i>Restore</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        @endif

    </div>

</x-layout-app>

<x-layout-app page-title="Colaborators">

    <div class="w-100 p-4">

        <h3>Todos os colaboradores</h3>

        <hr>

        @if($colaborators->count() === 0)
            
            <div class="text-center my-5">
                <p>Não foram encontrados colaboradores.</p>
            </div>

        @else
                
            <table class="table" id="table">
                <thead class="table-dark">
                    <tr >
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

                    @foreach ($colaborators as $colaborator)
                        
                        <tr>
                            <td class="bg-transparent">{{ $colaborator->name }}</td>
                            <td class="bg-transparent">{{ $colaborator->email }}</td>
                            <td class="bg-transparent">
                                @empty($colaborator->email_verified_at)
                                    <span class="badge bg-danger">No</span>
                                @else
                                    <span class="badge bg-success">Yes</span>
                                @endif
                            </td>

                            <td class="bg-transparent">{{ $colaborator->department?->name ?? 'N/A' }}</td>
                            <td class="bg-transparent">{{ $colaborator->role }}</td>
                            <td class="bg-transparent">{{ $colaborator->userDetails?->admission_date ?? 'N/A' }}</td>
                            <td class="bg-transparent">{{ $colaborator->userDetails?->salary ?? 'N/A' }} $</td>

                            <td class="bg-transparent">
                                <div class="d-flex gap-3 justify-content-end">
                                    @empty($colaborator->deleted_at)
                                        <a href="{{ route('colaborators.details', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-secondary ms-3"><i class="fas fa-eye me-2"></i>Details</a>
                                        <a href="{{ route('colaborators.delete', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-danger ms-3"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
                                    @else
                                        <form action="{{ route('colaborators.restore', ['id' => $colaborator->id]) }}" method="POST" class="d-inline">
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

</x-layout-app>

<x-layout-app page-title="Colaborator details">

    <div class="w-100 p-4">

        <h3>Colaborator details</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3">

                <div class="col">

                    <p>Name: <strong>{{ $user->name }}</strong></p>
                    <p>Email: <strong>{{ $user->email }}</strong></p>
                    <p>Role: <strong>{{ $user->role }}</strong></p>
                    <p>Permissions: </p>

                    @php
                        $permissions = json_decode($user->permissions);
                    @endphp
                    <ul>
                        @foreach ($permissions as $permission)
                            <li>{{ $permission }}</li>
                        @endforeach
                    </ul>

                    <p>Department: <strong>{{ $user->department->name }}</strong></p>
                    <p>Active:
                        
                        @empty($user->email_verified_at)
                            <span class="badge bg-danger">No</span>
                        @else
                            <span class="badge bg-success">Yes</span>
                        @endif
                    </p>
                </div>

                <div class="col">
                    <p>Address: <strong>{{ $user->userDetails->address }}</strong></p>
                    <p>Zip code: <strong>{{ $user->userDetails->zip_code }}</strong></p>
                    <p>City: <strong>{{ $user->userDetails->city }}</strong></p>
                    <p>Phone: <strong>{{ $user->userDetails->phone }}</strong></p>
                    <p>Admission date: <strong>{{ $user->userDetails->admission_date }}</strong></p>
                    <p>Salary: <strong>{{ $user->userDetails->salary }} $</strong></p>
                </div>
            </div>
        </div>

        <button class="btn btn-outline-secondary" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>

    </div>

</x-layout-app>
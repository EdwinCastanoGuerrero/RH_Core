<x-layout-app page-title="Edit colaborator">

    <div class="w-100 p-4">

        <h3>Edit colaborator</h3>

        <hr>

        <form action="#" method="post">

            @csrf

            <div class="d-flex gap-5">
                <p>Colaborator name: <strong>{{ $collaborator->name }}</strong></p>
                <p>Colaborator email: <strong>{{ $collaborator->email }}</strong></p>
            </div>

            <hr>

            <input type="hidden" name="user_id" value="{{ $collaborator->id }}">

            <div class="container-fluid">
                <div class="row gap-3">

                    {{-- user --}}
                    <div class="col border border-black p-4">
                        <div class="col">
                            <div class="mb-3">
                                <label for="salary" class="form-label">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" step=".01"
                                    value="{{ old('salary', $collaborator->userDetails->salary) }}">
                                @error('salary')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="admission_date" class="form-label">Admission Date</label>
                                <input type="text" class="form-control" id="admission_date" name="admission_date"
                                    placeholder="YYYY-mm-dd"
                                    value="{{ old('admission_date', $collaborator->userDetails->admission_date) }}">
                                @error('admission_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-select" id="select_department" name="select_department">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('select_department', $collaborator->department_id) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('select_department')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-3">
                    <a href="#" class="btn btn-outline-danger me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update colaborator</button>
                </div>

            </div>

        </form>

    </div>

</x-layout-app>

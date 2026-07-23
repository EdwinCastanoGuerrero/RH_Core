<div>
    <h3>Dados do Admin:</h3>
    <p>Nome: {{ $admin->name }}</p>
    <p>Email: {{ $admin->email }}</p>
    <p>Perfil: {{ $admin->role }}</p>
    <p>Permissões</p>
    <ul>
        @foreach(json_decode($admin->permissions) as $permission)
            <li>{{ $permission }}</li>
        @endforeach
    </ul>
    
    <h3>Detalhes</h3>
    <p>Endereço: {{ $admin->userDetails->address }}</p>
    <p>Zip Code: {{ $admin->userDetails->zip_code }}</p>
    <p>Cidade: {{ $admin->userDetails->city }}</p>
    <p>Telefone: {{ $admin->userDetails->phone }}</p>
    <p>Salário: {{ $admin->userDetails->salary }} €</p>
    <p>Data de Admissão: {{ $admin->userDetails->admission_date }}</p>
    <h3>Departamento</h3>
    <p>{{ $admin->department->name }}</p>
</div>
<x-layout-app page-title="Home">

    <h1 class="text-center">DENTRO DA APP</h1>

    @can('admin')
        <h2>Aqui está logado o Admin</h2>
    @endcan

</x-layout-app>
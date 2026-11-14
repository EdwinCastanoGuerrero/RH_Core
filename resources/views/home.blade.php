<x-layout-app page-title="Home">

    <div class="w-100 p-4">
        <h3>Home</h3>
        <hr>
        <div class="d-flex">
            <x-info-title-value title="Total de Funcionários" :value="$data['colaborators_count']" />
            <x-info-title-value title="Total de Funcionários Inativos" :value="$data['inactive_colaborators_count']" />
            <x-info-title-value title="Salário Total" :value="$data['total_salary']" />
        </div>
    </div>

    

</x-layout-app>
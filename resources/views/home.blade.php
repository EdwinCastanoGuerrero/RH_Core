<x-layout-app page-title="Home">

    <div class="w-100 p-4">
        <h3>Home</h3>
        <hr>

        <div class="card bg-transparent p-4 m-2 shadow-sm text-center">
            <img src="{{ asset('assets/images/logo.png') }}"
                 alt="RH Core"
                 class="img-fluid mx-auto"
                 style="max-height: 240px;">
        </div>
        <hr>

        <div class="d-flex">
            <x-info-title-value title="Total de Funcionários" :value="$data['colaborators_count']" />
            <x-info-title-value title="Total de Funcionários Inativos" :value="$data['inactive_colaborators_count']" />
            <x-info-title-value title="Salário Total" :value="$data['total_salary']" />
        </div>
        <hr>
        <div class="d-flex">
            <x-info-title-collection title="Distribuição por Departamento" :collection="$data['colaborators_by_department']" />
            <x-info-title-collection title="Salário por Departamento" :collection="$data['salary_by_department']" />
        </div>
    </div>

    

</x-layout-app>
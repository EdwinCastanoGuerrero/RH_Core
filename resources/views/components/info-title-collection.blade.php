<div class="card bg-transparent p-4 m-2 shadow-sm ">
    <h5 class="border-bottom border-primary pb-2">{{ $title }}</h5>
    <table class="table">
        @foreach ($collection as $item)
            <tr>
                <td>{{ $item['department'] }}</td>
                <td class="text-end">
                    {{ $item['total'] ?? $item['colaborators_count'] ?? $item['total_salary'] ?? 0 }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
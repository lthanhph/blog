<x-table :element-name="$tax_name">
    <x-slot name="head">
        <x-table-th style="width: 25%">title</x-table-th>
        <x-table-th>description</x-table-th>
    </x-slot>
    <x-slot name="body">
        @foreach ($terms as $index => $term)
            @php 
                $route_edit = route('term.edit', ['term' => $term->id]);
                $route_destroy = route('term.destroy', ['term' => $term->id]);
            @endphp
            <tr>
                <x-table-td-title>
                    <x-slot name="link" href="{{ $route_edit }}">{{ $term->title }}</x-slot>
                </x-table-td-title>
                <td>{{ $term->description }}</td>
                <x-table-action :index="$index" route-show="" :route-edit="$route_edit" :route-destroy="$route_destroy"/>
            </tr>
        @endforeach
    </x-slot>
    <x-slot name="pagination">
        {{ $terms->links('vendor.pagination.admin-bootstrap-4'); }}
    </x-slot>
</x-table>
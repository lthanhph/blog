<x-table element-name="user">
    <x-slot name="head">
        <x-table-th>name</x-table-th>
        <x-table-th>email</x-table-th>
        <x-table-th style="width: 20%">role</x-table-th>
    </x-slot>
    <x-slot name="body">
        @foreach ($users as $index => $user)
            @php 
                $route_edit = route('user.edit', ['user' => $user->id]);
                $route_destroy = route('user.destroy', ['user' => $user->id]);
            @endphp
            <tr>
                <x-table-td-title>
                    <x-slot name="link" href="{{ $route_edit }}">{{ $user->name }}</x-slot>
                </x-table-td-title>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <x-table-action :index="$index" :route-edit="$route_edit" :route-destroy="$route_destroy" />
            </tr>
        @endforeach
    </x-slot>
    <x-slot name="pagination">
        {{ $users->links('vendor.pagination.admin-bootstrap-4') }}
    </x-slot>
</x-table>
<x-table element-name="comment">
    <x-slot name="head">
        <x-table-th>name</x-table-th>
        <x-table-th>email</x-table-th>
        <x-table-th style="width: 25%">content</x-table-th>
        <x-table-th style="width: 15%">reply to</x-table-th>
        <x-table-th style="width: 20%">post</x-table-th>
    </x-slot>
    <x-slot name="body">
        @foreach ($comments as $index => $comment)
            @php 
            $route_edit = route('comment.edit', ['comment' => $comment->id]);
                $route_destroy = route('comment.destroy', ['comment' => $comment->id]);
            @endphp
            <tr>
                <x-table-td-title>
                    <x-slot name="link" href="{{ $route_edit }}">{{ $comment->name }}</x-slot>
                </x-table-td-title>
                <td>{{ $comment->email }}</td>
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->parent_name }}</td>
                <td>{{ $comment->post->title }}</td>
                <x-table-action :index="$index" :route-edit="$route_edit" :route-destroy="$route_destroy" />
            </tr>
        @endforeach 
    </x-slot>
    <x-slot name="pagination">
        {{ $comments->links('vendor.pagination.admin-bootstrap-4') }}
    </x-slot>
</x-table>
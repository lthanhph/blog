<x-table element-name="post">
    <x-slot name="head">
            <x-table-th>post title</x-table-th>
            <x-table-th style="width: 20%">categories</x-table-th>
            <x-table-th style="width: 10%">comments</x-table-th>
            <x-table-th style="width: 10%">user</x-table-th>
            <x-table-th style="width: 18%">last update</x-table-th>
    </x-slot>
    <x-slot name="body">
        @foreach ($posts as $index => $post)
            @php 
                $route_show = route('post.show', ['post' => $post->id]);
                $route_edit = route('post.edit', ['post' => $post->id]);
                $route_destroy = route('post.destroy', ['post' => $post->id]);
            @endphp
                <tr>
                    <x-table-td-title>
                        <x-slot name="link" href="{{ $route_edit }}">{{ $post->title }}</x-slot>
                    </x-table-td-title>
                    <td> {{ $post->all_category_title }} </td>
                    <td> {{ $post->comment_number }} </td>
                    <td> {{ $post->user->name }} </td>
                    <td> {{ $post->updated_at }}</td>
                    <x-table-action :index="$index" :route-show="$route_show" :route-edit="$route_edit" :route-destroy="$route_destroy" />
                </tr>
        @endforeach
    </x-slot>
    <x-slot name="pagination">
        {{ $posts->links('vendor.pagination.admin-bootstrap-4') }}
    </x-slot>
</x-table>

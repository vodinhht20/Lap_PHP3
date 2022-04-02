@extends('layout.master')

@section('title', 'Product page')

@section('content-title', 'Product page')

@section('content')
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Category</th>
            <th>List Product</th>
            <th>Remove</th>
        </thead>
        <tbody>
            @foreach ($news as $new)
                <tr>
                    <td>{{ $new->id }}</td>
                    <td>{{ $new->title }}</td>
                    <td>{{ $new->contents }}</td>
                    <td>{{ $new->category->name }}</td>
                    <td>
                        <ul>
                            @if (count($new->products) > 0)
                                @foreach ($new->products as $product)
                                    <li>{{ $product->name }}</li>
                                @endforeach
                            @else
                                <li>N/A</li>
                            @endif
                        </ul>
                    </td>
                    <td class="row">
                        <button type="submit" class="btn btn-danger btn-delete" data-id="{{ $new->id }}">
                            Delete
                        </button>
                        <a href="{{ route('new.edit', ['id' => $new->id]) }}" class="btn btn-info mt-3" data-id="{{ $new->id }}">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $news->links() }}
@endsection

@section('script-page')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
    <script>
        $('.btn-delete').on('click', function() {
            if(confirm('Ban co muon xoa san pham nay khong ?')) {
                const options = {
                    _token: '{{ csrf_token() }}',
                    id: $(this).attr('data-id')
                }
                axios.post('{{ route("new.remove") }}', options)
                    .then((response) => {
                        location.reload();
                    })
                    .catch((error) => {
                        alert("Xoa that bai")
                    })
            }
        })
    </script>
@endsection
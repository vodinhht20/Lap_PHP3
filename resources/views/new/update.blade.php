{{-- Neu edit thi se co bien $product truyen vao --}}
@extends('layout.master')

@section('title', 'Product page')

@section('content-title')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (Session::has('message.error'))
                <span>{{ Session::get('message.error') }}</span>
            @endif
            <form action="{{ route('new.update', ['id' => $new->id]) }}" class="form" method="POST">
                @csrf   
                <div class="form-group">
                    <label for="name">Title</label>
                    <input class="form-control" name="title" value="{{ $new->title }}"/>
                </div>
                <div class="form-group">
                    <label for="name">Link Image</label>
                    <input class="form-control" name="images" value="{{ $new->images }}"/>
                </div>
                <div class="form-group">
                    <label for="name">Category</label>
                    <select class="form-control" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{$category->id == $new->category_id ? "selected" : ""}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Content</label>
                    <textarea class="form-control" name="contents">{{ $new->contents }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sumit</button>
                    <a href="{{route('categories.index')}}" class="btn btn-warning">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <h5>Danh sách sản phấm có bài viết</h5>
            <ul>
                @if (count($new->products) > 0)
                    @foreach ($new->products as $product)
                        <li>{{ $product->name }}</li>
                    @endforeach
                @else
                    <li>N/A</li>
                @endif
            </ul>
        </div>
    </div>

@endsection

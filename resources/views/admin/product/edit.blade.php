@extends('layout.admin')
@section('content')
    <form action="{{ route('update', $product->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}">
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="{{ $product->price }}">
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ $product->stock }}">
        </div>
        <button type="submit">Edit</button>
    </form>
@endsection
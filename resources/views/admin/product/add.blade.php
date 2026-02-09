@extends('layout.admin')
@section('content')
    <form action="{{ route('store') }}" method="post">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price">
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock">
        </div>
        <button type="submit">Add</button>
    </form>
@endsection
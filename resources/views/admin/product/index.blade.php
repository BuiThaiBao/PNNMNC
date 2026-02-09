@extends('layout.admin')
@section('content')
    <a href="{{ route('create') }}">Create Product</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['stock'] }}</td>
                    <td><a href="{{ route('edit', $product['id']) }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
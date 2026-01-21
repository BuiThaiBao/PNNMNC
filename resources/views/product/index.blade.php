<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
</head>

<body>
    Product List
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @php
                $products = [
                    [
                        'id' => 1,
                        'name' => 'Product 1',
                        'price' => 100,
                        'description' => 'Description 1',
                    ],
                    [
                        'id' => 2,
                        'name' => 'Product 2',
                        'price' => 100,
                        'description' => 'Description 2',
                    ],
                    [
                        'id' => 3,
                        'name' => 'Product 3',
                        'price' => 100,
                        'description' => 'Description 3',
                    ],
                    [
                        'id' => 4,
                        'name' => 'Product 4',
                        'price' => 100,
                        'description' => 'Description 4',
                    ],
                    [
                        'id' => 5,
                        'name' => 'Product 5',
                        'price' => 100,
                        'description' => 'Description 5',
                    ],
                    [
                        'id' => 6,
                        'name' => 'Product 6',
                        'price' => 100,
                        'description' => 'Description 6',
                    ],

                ];
            @endphp
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['description'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('add') }}">Add Product</a>

</body>

</html>
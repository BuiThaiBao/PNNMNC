@extends('layout.admin')
@section('content')
    <h3>Danh sách Sản phẩm</h3>

    <!-- Search / Filter -->
    <form action="{{ route('product') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="keyword" class="form-control mr-2" placeholder="Tìm theo tên..."
            value="{{ request('keyword') }}">
        <select name="category_id" class="form-control mr-2">
            <option value="">-- Tất cả danh mục --</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-info mr-2">Lọc</button>
        <a href="{{ route('create_product') }}" class="btn btn-primary">Thêm mới</a>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Sale Price</th>
                <th>Stock</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>{{ $product->sale_price ? number_format($product->sale_price) : '-' }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="text-center">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input toggle-active" id="active_{{ $product->id }}"
                                data-id="{{ $product->id }}" {{ $product->is_active ? 'checked' : '' }}>
                            <label class="custom-control-label" for="active_{{ $product->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('edit_product', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('delete_product', $product->id) }}" class="btn btn-sm btn-danger"
                            onclick="return confirm('Bạn có chắc muốn xóa?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.toggle-active').on('change', function () {
                var productId = $(this).data('id');
                var url = "{{ url('admin/product/active') }}/" + productId;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    },
                    success: function (response) {
                        if (response.success) {
                            console.log('Product active status updated');
                        }
                    },
                    error: function (xhr) {
                        console.error('Error', xhr.responseText);
                        var checkbox = $('#active_' + productId);
                        checkbox.prop('checked', !checkbox.prop('checked'));
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            });
        });
    </script>
@endpush
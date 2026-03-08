@extends('layout.admin')
@section('content')
    <h3>Thêm Sản phẩm</h3>
    <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="category_id">Danh mục</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="price">Giá <span class="text-danger">*</span></label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" min="0"
                value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="sale_price">Giá khuyến mãi</label>
            <input type="number" name="sale_price" id="sale_price" class="form-control" step="0.01" min="0"
                value="{{ old('sale_price') }}">
        </div>
        <div class="form-group">
            <label for="stock">Số lượng tồn <span class="text-danger">*</span></label>
            <input type="number" name="stock" id="stock" class="form-control" min="0" value="{{ old('stock', 0) }}">
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Ảnh sản phẩm</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
        </div>
        <div class="form-group">
            <label for="is_active">Trạng thái</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('product') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
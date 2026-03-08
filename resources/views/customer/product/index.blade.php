@extends('layout.customer')

@section('title', 'Sản phẩm - ShopOnline')

@section('content')

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Sản phẩm của chúng tôi</h1>
        <p>Khám phá bộ sưu tập sản phẩm chất lượng cao với giá tốt nhất</p>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('customer.product') }}" method="GET" class="filter-bar">
        <div class="filter-group">
            <i class="fas fa-search"></i>
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." value="{{ request('keyword') }}">
        </div>
        <div class="filter-group">
            <i class="fas fa-layer-group"></i>
            <select name="category_id">
                <option value="">Tất cả danh mục</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-filter">
            <i class="fas fa-filter"></i> Lọc
        </button>
    </form>

    <!-- Products Grid -->
    @if ($products->count() > 0)
        <div class="products-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if ($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div class="no-image">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        @if ($product->sale_price)
                            <span class="badge-sale">SALE</span>
                        @endif
                    </div>
                    <div class="product-info">
                        <span class="product-category">
                            {{ $product->category ? $product->category->name : 'Chưa phân loại' }}
                        </span>
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-desc">{{ Str::limit($product->description, 80) }}</p>
                        <div class="product-bottom">
                            <div class="product-price">
                                @if ($product->sale_price)
                                    <span class="price-old">{{ number_format($product->price) }}đ</span>
                                    <span class="price-current">{{ number_format($product->sale_price) }}đ</span>
                                @else
                                    <span class="price-current">{{ number_format($product->price) }}đ</span>
                                @endif
                            </div>
                            <div class="product-stock">
                                @if ($product->stock > 0)
                                    <span class="in-stock"><i class="fas fa-check-circle"></i> Còn hàng</span>
                                @else
                                    <span class="out-stock"><i class="fas fa-times-circle"></i> Hết hàng</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>Không tìm thấy sản phẩm</h3>
            <p>Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm</p>
        </div>
    @endif

@endsection

@push('styles')
    <style>
        /* ===== HERO ===== */
        .hero-section {
            text-align: center;
            padding: 2.5rem 1rem 1.5rem;
        }

        .hero-section h1 {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .hero-section p {
            color: #6b7280;
            font-size: 1.05rem;
        }

        /* ===== FILTER BAR ===== */
        .filter-bar {
            display: flex;
            gap: 1rem;
            align-items: center;
            background: #fff;
            padding: 1rem 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
            min-width: 200px;
            background: #f5f6fa;
            border-radius: 10px;
            padding: 0.6rem 1rem;
            transition: box-shadow 0.2s;
        }

        .filter-group:focus-within {
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.3);
        }

        .filter-group i {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .filter-group input,
        .filter-group select {
            border: none;
            background: transparent;
            outline: none;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: #1a1a2e;
            width: 100%;
        }

        .btn-filter {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            white-space: nowrap;
        }

        .btn-filter:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        /* ===== PRODUCTS GRID ===== */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        /* ===== PRODUCT CARD ===== */
        .product-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .product-image {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f6fa, #e8ecf1);
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.08);
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #d1d5db;
        }

        .badge-sale {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(244, 63, 94, 0.4);
        }

        .product-info {
            padding: 1.2rem;
        }

        .product-category {
            font-size: 0.75rem;
            font-weight: 600;
            color: #667eea;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-name {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0.4rem 0;
            color: #1a1a2e;
            line-height: 1.3;
        }

        .product-desc {
            font-size: 0.85rem;
            color: #9ca3af;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .product-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.8rem;
            border-top: 1px solid #f3f4f6;
        }

        .price-old {
            text-decoration: line-through;
            color: #9ca3af;
            font-size: 0.85rem;
            margin-right: 0.4rem;
        }

        .price-current {
            font-size: 1.15rem;
            font-weight: 800;
            color: #e11d48;
        }

        .in-stock {
            font-size: 0.8rem;
            color: #10b981;
            font-weight: 500;
        }

        .out-stock {
            font-size: 0.8rem;
            color: #ef4444;
            font-weight: 500;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.3rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.6rem;
            }

            .filter-bar {
                flex-direction: column;
            }

            .filter-group {
                min-width: 100%;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
        }
    </style>
@endpush
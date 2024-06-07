@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center">Product Page</h1><br>
            <div class="row">
                <div class="col-md-9">
                    <div class="row" id="product-list">
                        <!-- Products -->
                        @foreach($products as $product)
                        <div class="col-md-4 mb-4 product-card" data-category="{{ $product->category_id }}">
                            <div class="card">
                                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title px-2">{{ $product->name }}</h5>
                                    <p class="card-text px-2">{{ format_price($product->price) }}</p>
                                    <div class="d-flex justify-content-around">
                                        <button class="btn btn-primary btn-min-width view-btn" data-id="{{ $product->id }}">View</button>
                                        <button class="btn btn-success btn-min-width">Buy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Product Category</h4><br>
                                <!-- Category Cards -->
                                <div class="card mb-2 category-card active" data-category="0">
                                    <div class="card-body">
                                        <h6 class="card-title">All Categories</h6>
                                    </div>
                                </div>
                                @foreach($categories as $category)
                                <div class="card mb-2 category-card" data-category="{{ $category->id }}">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $category->name }}</h6>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalProductImage" src="" alt="Product Image" class="img-fluid mb-3 modal-img">
                <h2><strong><a id="modalProductPrice"></a></strong></h2>
                <h3 id="modalProductName"></h3>
                <p id="modalProductDescription"></p>
                <p id="modalProductStock"></p>
            </div>
            <div class="modal-footer flex">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" id="decrement">-</button>
                                <input type="text" class="form-control text-center" id="quantity" value="1" min="1">
                                <button class="btn btn-outline-secondary" type="button" id="increment">+</button>
                            </div>
                        </div>
                        <div class="col-auto">
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" id="product_id" name="product_id">
                                <input type="hidden" id="product_quantity" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@vite(['resources/js/home.js'])
@endsection

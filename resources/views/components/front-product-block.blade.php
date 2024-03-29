<div class="product-o product-o--hover-on p-4">
    <div class="product-o__wrap product-shadow">
        <a class="aspect aspect--bg-grey aspect--square u-d-block" href="{{ route('frontend.product.detail', ['product' => $product]) }}">
            @if ($product->getFirstMediaUrl('products', 'small'))
                <img class="aspect__img" src="{{ $product->getFirstMediaUrl('products', 'small') }}" alt="{{ $product->name }}">
            @else
                <img class="aspect__img" src="{{ asset('frontend/dist/images/product/square-default-image.jpeg') }}" alt="{{ $product->name }}">
            @endif
        </a>
        <div class="product-o__action-wrap">
            <ul class="product-o__action-list">
                <li>
                    <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick View"><i class="fas fa-search-plus"></i></a>
                </li>
                <li>
                    <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-plus-circle"></i></a>
                </li>
                <li>
                    <a href="signin.html" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist"><i class="fas fa-heart"></i></a>
                </li>
                <li>
                    <a href="signin.html" data-tooltip="tooltip" data-placement="top" title="Email me When the price drops"><i class="fas fa-envelope"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-content">
        <span class="product-o__category">
            <a href="{{ route('frontend.category.products', ['url' => $product->category->url]) }}">{{ $product->category->name }}</a>
        </span>
        <span class="product-o__name">
            <a href="{{ route('frontend.product.detail', ['product' => $product]) }}">{{ Str::limit($product->name, 25, '..') }}</a>
        </span>
        <div class="product-o__rating gl-rating-style">
            @php
                $reviews_count = product_reviews($product->id)->count();
                $reviews_avg = $reviews_count ? product_reviews($product->id)->sum('rating') / $reviews_count : 0;
            @endphp
            @for ($i = 1; $i <= $reviews_avg; $i++)
                <i class="fas fa-star"></i>
            @endfor
            @if ($reviews_avg - floor($reviews_avg) > 0)
                <i class="fas fa-star-half-alt"></i>
            @endif
            <span class="product-o__review">{{ $reviews_count ?? 0 }} {{ __('frontend.reviews') }}</span>
        </div>
        @php
            $dataPrices = App\Models\Product::applyDiscount($product->id, $product->price);
        @endphp
        @isset($dataPrices)
            @if ($dataPrices['discount'] > 0)
                <span class="font-weight-bold product-o__price text-green-600">
                    ${{ $dataPrices['final_price'] }}
                    <span class="text-secondary font-weight-normal product-o__discount text-red-600">${{ $dataPrices['original_price'] }}</span>
                </span>
            @else
                <span class="font-weight-bold product-o__price">
                    ${{ $product->price }}
                </span>
            @endif
        @endisset
    </div>
</div>

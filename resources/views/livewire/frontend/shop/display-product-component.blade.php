 <div>
     <div class="u-s-p-y-90">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="shop-p">
                         <div class="shop-p__toolbar u-s-m-b-30">
                             <div class="shop-p__tool-style">
                                 <div class="tool-style__group u-s-m-b-8">
                                     <span class="js-shop-filter-target" data-side="#side-filter">Filters</span>
                                     <span class="js-shop-grid-target">Grid</span>
                                     <span class="js-shop-list-target is-active">List</span>
                                 </div>
                                 <div class="tool-style__form-wrap">
                                     <div class="u-s-m-b-8">
                                         <select class="font-bold text-black form-select-sm text-xs rounded-none" wire:model='per_page'>
                                             <option value="8">{{ __('frontend.show') }}: 8</option>
                                             <option value="12">{{ __('frontend.show') }}: 12</option>
                                             <option value="16">{{ __('frontend.show') }}: 16</option>
                                             <option value="28">{{ __('frontend.show') }}: 28</option>
                                         </select>
                                     </div>
                                     <div class="u-s-m-b-8">
                                         <select class="font-bold text-black form-select-sm text-xs rounded-none" wire:model='order_by'>
                                             <option value="created_at">{{ __('frontend.sort_by') }}: Newest Items</option>
                                             <option value="name">{{ __('frontend.sort_by') }}: Name</option>
                                             <option value="price">{{ __('frontend.sort_by') }}: Price</option>
                                             <option value="is_best_seller">{{ __('frontend.sort_by') }}: Best Selling</option>
                                         </select>
                                     </div>
                                     <div class="u-s-m-b-8">
                                         <select class="font-bold text-black form-select-sm text-xs rounded-none" wire:model='sort_by'>
                                             <option value="asc">{{ __('frontend.asc') }}</option>
                                             <option value="desc">{{ __('frontend.desc') }}</option>
                                         </select>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="shop-p__collection">
                             <div class="row is-list-active">
                                 @forelse ($products as $product)
                                     <div class="col-lg-3 col-md-4 col-sm-6">
                                         <div class="product-m">
                                             <div class="product-m__thumb">
                                                 <a class="aspect aspect--bg-grey aspect--square u-d-block" href="{{ route('frontend.product.detail', ['product' => $product]) }}">
                                                     @if ($product->getFirstMediaUrl('products', 'medium'))
                                                         <img class="aspect__img" src="{{ $product->getFirstMediaUrl('products', 'medium') }}" alt="{{ $product->name }}">
                                                     @else
                                                         <img class="aspect__img" src="{{ asset('frontend/dist/images/product/square-default-image.jpeg') }}" alt="{{ $product->name }}">
                                                     @endif
                                                 </a>
                                                 <div class="product-m__quick-look">
                                                     <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a>
                                                 </div>
                                                 <div class="product-m__add-cart">
                                                     <a class="btn--e-brand" data-modal="modal" data-modal-id="#add-to-cart">{{ __('frontend.add_to_card') }}</a>
                                                 </div>
                                             </div>
                                             <div class="product-m__content">
                                                 <div class="product-m__category">
                                                     <a href="{{ route('frontend.category.products', ['url' => $product->category->url]) }}">{{ $product->category->name }}</a>
                                                 </div>
                                                 <div class="product-m__name">
                                                     <a href="{{ route('frontend.product.detail', ['product' => $product]) }}">{{ Str::limit($product->name, 25, '...') }}</a>
                                                 </div>
                                                 <div class="product-m__rating gl-rating-style">
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
                                                     <span class="product-m__review">{{ $reviews_count ?? 0 }} {{ __('frontend.reviews') }}</span>
                                                 </div>
                                                 @php
                                                     $dataPrices = App\Models\Product::applyDiscount($product->id, $product->price);
                                                 @endphp
                                                 @isset($dataPrices)
                                                     @if ($dataPrices['discount'] > 0)
                                                         <span class="text-green-600 font-weight-bold product-o__price">
                                                             ${{ $dataPrices['final_price'] }}
                                                             <span class="text-red-600 font-weight-normal product-o__discount ">${{ $dataPrices['original_price'] }}</span>
                                                         </span>
                                                     @else
                                                         <span class="product-m__price">
                                                             ${{ $product->price }}
                                                         </span>
                                                     @endif
                                                 @endisset
                                                 <div class="product-m__hover">
                                                     <div class="product-m__preview-description">
                                                         <span>{{ $product->description }}</span>
                                                     </div>
                                                     <div class="product-m__wishlist">
                                                         <a class="far fa-heart {{ auth()->user()?->wishlists->where('product_id', $product->id)->count() > 0? 'text-main-color': '' }}" title="Add to Wishlist" wire:click.prevent='addToWishlist({{ $product->id }})'></a>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 @empty
                                     <div class="empty" style="margin-top: 6rem">
                                         <div class="empty-img">
                                             <img src="{{ asset('backend/static/illustrations/undraw_printing_invoices_5r4r.svg') }}" height="128" width="400" alt="{{ __('msgs.not_found') }}" class="m-auto d-block">
                                         </div>
                                         <h3 class="empty-title mt-4">{{ __('msgs.not_found') }}</h3>
                                     </div>
                                 @endforelse
                             </div>
                         </div>
                         @if ($products->count() > 10)
                             <div class="u-s-p-y-60">
                                 <!--====== Pagination ======-->
                                 {{ $products?->links('vendor.custom-pagination') }}
                                 <!--====== End - Pagination ======-->
                             </div>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="shop-a" id="side-filter" wire:ignore.self=''>
         <div class="shop-a__wrap">
             <div class="shop-a__inner gl-scroll">
                 <div class="shop-w-master">
                     <h1 class="shop-w-master__heading u-s-m-b-30"><i class="fas fa-filter u-s-m-r-8"></i>
                         <span>{{ __('frontend.filters') }}</span>
                     </h1>
                     <div class="shop-w-master__sidebar">
                         <!-- Categories -->
                         @include('livewire.frontend.shop.inc.category-filter')

                         <!-- Stars Filters -->
                         @include('livewire.frontend.shop.inc.rating-filter')

                         <!-- Price Filters -->
                         @include('livewire.frontend.shop.inc.price-filter')

                         <!-- Brand Filters -->
                         @include('livewire.frontend.shop.inc.brand-filter')
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

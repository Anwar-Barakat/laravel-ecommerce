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
                                                         <img class="aspect__img" src="{{ asset('frontend/dist/images/product/electronic/product6.jpg') }}" alt="{{ $product->name }}">
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
                                                         <span class="font-weight-bold product-o__price text-green">
                                                             ${{ $dataPrices['final_price'] }}
                                                             <span class="text-secondary font-weight-normal product-o__discount text-red">${{ $dataPrices['original_price'] }}</span>
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
                                                         <a class="far fa-heart" href="#" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist"></a>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 @empty
                                     <div class="empty ">
                                         <div class="empty-img">
                                             <img src="{{ asset('backend/static/illustrations/undraw_printing_invoices_5r4r.svg') }}" height="128" width="400" alt="{{ __('msgs.not_found') }}" class="m-auto d-block">
                                         </div>
                                         <h5 class="empty-title mt-4">{{ __('msgs.not_found') }}</h5>
                                     </div>
                                 @endforelse
                             </div>
                         </div>
                         <div class="u-s-p-y-60">
                             <!--====== Pagination ======-->
                             {{ $products->links() }}
                             <!--====== End - Pagination ======-->
                         </div>
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

                         <div class="u-s-m-b-30">
                             <div class="shop-w">
                                 <div class="shop-w__intro-wrap">
                                     <h1 class="shop-w__h">SHIPPING</h1>

                                     <span class="fas fa-minus shop-w__toggle" data-target="#s-shipping" data-toggle="collapse"></span>
                                 </div>
                                 <div class="shop-w__wrap show" id="s-shipping">
                                     <ul class="shop-w__list gl-scroll">
                                         <li>

                                             <!--====== Check Box ======-->
                                             <div class="check-box">

                                                 <input type="checkbox" id="free-shipping">
                                                 <div class="check-box__state check-box__state--primary">

                                                     <label class="check-box__label" for="free-shipping">Free Shipping</label>
                                                 </div>
                                             </div>
                                             <!--====== End - Check Box ======-->
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>

                         <div class="u-s-m-b-30">
                             <div class="shop-w">
                                 <div class="shop-w__intro-wrap">
                                     <h1 class="shop-w__h">PRICE</h1>

                                     <span class="fas fa-minus shop-w__toggle" data-target="#s-price" data-toggle="collapse"></span>
                                 </div>
                                 <div class="shop-w__wrap show" id="s-price">
                                     <form class="shop-w__form-p">
                                         <div class="shop-w__form-p-wrap">
                                             <div>

                                                 <label for="price-min"></label>

                                                 <input class="input-text input-text--primary-style" type="text" id="price-min" placeholder="Min">
                                             </div>
                                             <div>

                                                 <label for="price-max"></label>

                                                 <input class="input-text input-text--primary-style" type="text" id="price-max" placeholder="Max">
                                             </div>
                                             <div>

                                                 <button class="btn btn--icon fas fa-angle-right btn--e-transparent-platinum-b-2" type="submit"></button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                         <div class="u-s-m-b-30">
                             <div class="shop-w">
                                 <div class="shop-w__intro-wrap">
                                     <h1 class="shop-w__h">MANUFACTURER</h1>

                                     <span class="fas fa-minus shop-w__toggle" data-target="#s-manufacturer" data-toggle="collapse"></span>
                                 </div>
                                 <div class="shop-w__wrap show" id="s-manufacturer">
                                     <ul class="shop-w__list-2">
                                         <li>
                                             <div class="list__content">

                                                 <input type="checkbox" checked>

                                                 <span>Calvin Klein</span>
                                             </div>

                                             <span class="shop-w__total-text">(23)</span>
                                         </li>
                                         <li>
                                             <div class="list__content">

                                                 <input type="checkbox">

                                                 <span>Diesel</span>
                                             </div>

                                             <span class="shop-w__total-text">(2)</span>
                                         </li>
                                         <li>
                                             <div class="list__content">

                                                 <input type="checkbox">

                                                 <span>Polo</span>
                                             </div>

                                             <span class="shop-w__total-text">(2)</span>
                                         </li>
                                         <li>
                                             <div class="list__content">

                                                 <input type="checkbox">

                                                 <span>Tommy Hilfiger</span>
                                             </div>

                                             <span class="shop-w__total-text">(9)</span>
                                         </li>
                                         <li>
                                             <div class="list__content">

                                                 <input type="checkbox">

                                                 <span>Ndoge</span>
                                             </div>

                                             <span class="shop-w__total-text">(3)</span>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                         <div class="u-s-m-b-30">
                             <div class="shop-w">
                                 <div class="shop-w__intro-wrap">
                                     <h1 class="shop-w__h">COLOR</h1>

                                     <span class="fas fa-minus shop-w__toggle" data-target="#s-color" data-toggle="collapse"></span>
                                 </div>
                                 <div class="shop-w__wrap show" id="s-color">
                                     <ul class="shop-w__list gl-scroll">
                                         <li>
                                             <div class="color__check">

                                                 <input type="checkbox" id="jet">

                                                 <label class="color__check-label" for="jet" style="background-color: #333333"></label>
                                             </div>

                                             <span class="shop-w__total-text">(2)</span>
                                         </li>
                                         <li>
                                             <div class="color__check">

                                                 <input type="checkbox" id="folly">

                                                 <label class="color__check-label" for="folly" style="background-color: #FF0055"></label>
                                             </div>

                                             <span class="shop-w__total-text">(4)</span>
                                         </li>
                                         <li>
                                             <div class="color__check">

                                                 <input type="checkbox" id="yellow">

                                                 <label class="color__check-label" for="yellow" style="background-color: #FFFF00"></label>
                                             </div>

                                             <span class="shop-w__total-text">(6)</span>
                                         </li>
                                         <li>
                                             <div class="color__check">

                                                 <input type="checkbox" id="granite-gray">

                                                 <label class="color__check-label" for="granite-gray" style="background-color: #605F5E"></label>
                                             </div>

                                             <span class="shop-w__total-text">(8)</span>
                                         </li>
                                         <li>
                                             <div class="color__check">

                                                 <input type="checkbox" id="space-cadet">

                                                 <label class="color__check-label" for="space-cadet" style="background-color: #1D3461"></label>
                                             </div>

                                             <span class="shop-w__total-text">(10)</span>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

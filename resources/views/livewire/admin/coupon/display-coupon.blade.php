 <div class="card">
     <div class="card-header d-flex align-items-center justify-content-between">
         <h3 class="card-title">{{ __('msgs.all', ['name' => __('product.coupons')]) }}</h3>
         <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
             {{ __('msgs.create', ['name' => __('product.coupon')]) }}
         </a>
     </div>
     <div class="card-body">
         <div class="row">
             <div class="col-sm-12 col-md-4 col-lg-2">
                 <div class="mb-3">
                     <x-input-label class="form-label" :value="__('msgs.order_by')" />
                     <select class="form-select" wire:model='order_by'>
                         <option value="">{{ __('btns.select') }}</option>
                         <option value="expiry_date">{{ __('product.expiry_date') }}</option>
                         <option value="created_at">{{ __('msgs.created_at') }}</option>
                     </select>
                 </div>
             </div>
             <div class="col-sm-12 col-md-4 col-lg-2">
                 <div class="mb-3">
                     <x-input-label class="form-label" :value="__('msgs.per_page')" />
                     <select class="form-select" wire:model='per_page'>
                         <option value="">{{ __('btns.select') }}</option>
                         <option value="5">5</option>
                         <option value="10">10</option>
                         <option value="15">15</option>
                     </select>
                 </div>
             </div>
             <div class="col-sm-12 col-md-4 col-lg-2">
                 <div class="mb-3">
                     <x-input-label class="form-label" :value="__('msgs.sort_by')" />
                     <select class="form-select" wire:model='sort_by'>
                         <option value="">{{ __('btns.select') }}</option>
                         <option value="asc">{{ __('msgs.asc') }}</option>
                         <option value="desc">{{ __('msgs.desc') }}</option>
                     </select>
                 </div>
             </div>
             <div class="col-sm-12 col-md-4 col-lg-2">
                 <div class="mb-3">
                     <x-input-label class="form-label" :value="__('product.expiry_date_from')" />
                     <x-text-input type="date" class="form-control" wire:model='expiry_date_from' />
                 </div>
             </div>
             <div class="col-sm-12 col-md-4 col-lg-2">
                 <div class="mb-3">
                     <x-input-label class="form-label" :value="__('product.expiry_date_to')" />
                     <x-text-input type="date" class="form-control" wire:model='expiry_date_to' />
                 </div>
             </div>
         </div>
         <br>
         <div id="table-default" class="table-responsive">
             <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th> {{ __('product.coupon_option') }}</th>
                         <th> {{ __('product.coupon_code') }}</th>
                         <th class="text-center w-25"> {{ __('category.categories') }}</th>
                         <th> {{ __('product.coupon_type') }}</th>
                         <th> {{ __('product.amount') }}</th>
                         <th> {{ __('product.expiry_date') }}</th>
                         <th>{{ __('setting.status') }}</th>
                         <th></th>
                     </tr>
                 </thead>
                 <tbody class="table-tbody">
                     @forelse ($coupons as $coupon)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ __('product.' . App\Models\Coupon::COUPONOPTION[$coupon->option]) }}</td>
                             <td>{{ $coupon->code }}</td>
                             <td class="text-center">
                                 @foreach ($coupon->categories as $id)
                                     <span class="badge bg-blue mb-2">{{ App\Models\Category::find($id)->name }}</span>
                                 @endforeach
                             </td>
                             <td>{{ __('product.' . App\Models\Coupon::COUPONTYPE[$coupon->type]) }}</td>
                             <td>
                                 {{ $coupon->amount }}
                                 {{ $coupon->amount_type ? '$' : '%' }}
                             </td>
                             <td><span class="badge bg-red-lt"> {{ $coupon->expiry_date }}</span></td>
                             <td>
                                 <div>
                                     <button wire:click='updateStatus({{ $coupon }})' class="btn position-relative">
                                         {{ $coupon->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                         <span class="badge {{ $coupon->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                     </button>
                                 </div>
                             </td>
                             <td>
                                 <span class="dropdown">
                                     <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('btns.actions') }}</button>
                                     <div class="dropdown-menu">
                                         <a href="{{ route('admin.coupons.edit', ['coupon' => $coupon]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                 <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                 <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                 <path d="M16 5l3 3" />
                                             </svg>
                                             <span>{{ __('btns.edit') }}</span>
                                         </a>
                                         <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $coupon->id }}">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                 <path d="M4 7l16 0" />
                                                 <path d="M10 11l0 6" />
                                                 <path d="M14 11l0 6" />
                                                 <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                 <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                             </svg>
                                             <span>{{ __('btns.delete') }}</span>
                                         </a>
                                     </div>
                                 </span>
                                 {{-- <x-modal-delete :id="$coupon->id" :action="route('admin.coupons.destroy', ['coupon' => $coupon])" /> --}}
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="9" class="border-bottom-0">
                                 <x-blank-section :url="route('admin.coupons.create')" :content="__('product.coupon')" />
                             </td>
                         </tr>
                     @endforelse
                 </tbody>
             </table>
             <div class="mt-3">
                 {{ $coupons->links('pagination::bootstrap-5') }}
             </div>
         </div>
     </div>
     <div class="card-footer">
     </div>
 </div>

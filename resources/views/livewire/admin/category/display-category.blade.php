 <div class="card">
     <div class="card-header d-flex align-items-center justify-content-between">
         <h3 class="card-title">{{ __('msgs.all', ['name' => __('category.categories')]) }}</h3>
         <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
             {{ __('msgs.create', ['name' => __('category.category')]) }}
         </a>
     </div>
     <div class="card-body">
         <div class="row">
             <div class="col-sm-12 col-md-4 col-lg-2">
                 <div class="mb-3">
                     <x-input-label class="form-label" :value="__('msgs.search_by_name')" />
                     <x-text-input class="form-control" placeholder="{{ __('btns.search') }}" wire:model="name" />
                 </div>
             </div>
             <div class="col-sm-12 col-md-4 col-lg-2">
                 <div class="mb-3">
                     <x-input-label class="form-label" :value="__('section.section')" />
                     <select class="form-select" wire:model='section_id'>
                         <option value="">{{ __('btns.select') }}</option>
                         @foreach (App\Models\Section::all() as $section)
                             <option value="{{ $section->id }}">{{ $section->name }}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
             <div class="col-sm-12 col-md-4 col-lg-2">
                 <div class="mb-3">
                     <x-input-label class="form-label" :value="__('msgs.order_by')" />
                     <select class="form-select" wire:model='order_by'>
                         <option value="">{{ __('btns.select') }}</option>
                         <option value="name">{{ __('category.category_name') }}</option>
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
                     <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                 </div>
             </div>
         </div>
         <br>
         <div id="table-default" class="table-responsive">
             <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th> {{ __('category.category') }}</th>
                         <th> {{ __('section.section') }}</th>
                         <th> {{ __('category.parent_id') }}</th>
                         <th> {{ __('setting.status') }}</th>
                         <th> {{ __('msgs.created_at') }}</th>
                         <th></th>
                     </tr>
                 </thead>
                 <tbody class="table-tbody">
                     @forelse ($categories as $category)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $category->name }}</td>
                             <td>
                                 <span class="badge badge-outline text-blue">{{ $category->section->name }}</span>
                             </td>
                             <td>
                                 @if ($category->parent_id == '0')
                                     <span class="badge badge-outline text-green">{{ __('msgs.parent') }}</span>
                                 @else
                                     <span class="badge badge-outline text-purple">
                                         {{ $category->parentCategory->name }}
                                     </span>
                                 @endif
                             </td>
                             <td>
                                 <div>
                                     <button wire:click='updateStatus({{ $category->id }})' class="btn position-relative">
                                         {{ $category->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                         <span class="badge {{ $category->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                     </button>
                                 </div>
                             </td>
                             <td> {{ $category->created_at }} </td>
                             <td>
                                 <span class="dropdown">
                                     <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('btns.actions') }}</button>
                                     <div class="dropdown-menu">
                                         <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                 <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                 <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                 <path d="M16 5l3 3" />
                                             </svg>
                                             <span>{{ __('btns.edit') }}</span>
                                         </a>
                                         <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $category->id }}">
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
                                 {{-- <x-modal-delete :id="$category->id" :action="route('admin.categories.destroy', ['category' => $category])" /> --}}
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="7" class="border-bottom-0">
                                 <x-blank-section :url="route('admin.categories.create')" :content="__('category.category')" />
                             </td>
                         </tr>
                     @endforelse
                 </tbody>
             </table>
             <div class="mt-3">
                 {{ $categories->links('pagination::bootstrap-5') }}
             </div>
         </div>
     </div>
     <div class="card-footer">
     </div>
 </div>

<x-master-layout>
    @section('pageTitle', __('msgs.add', ['name' => __('product.attachments')]))
    @section('breadcrumbTitle', __('msgs.add', ['name' => __('product.attachments')]))
    @section('breadcrumbSubtitle', __('product.products'))

    <div class="row">
        @include('admin.products.inc.main-info', ['product' => $product])
        <div class="col-12 col-lg-8 mb-3 d-flex flex-column">
            <div class="card">
                <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-article" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                            <path d="M7 8h10"></path>
                            <path d="M7 12h10"></path>
                            <path d="M7 16h10"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-header">
                    <h3 class="card-title">{{ __('product.product_attachments') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 text-center m-auto">
                            <div id="carousel-indicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach ($product->getMedia('product_attachments') as $key => $attachment)
                                        <button type="button" data-bs-target="#carousel-indicators" data-bs-slide-to="{{ $key }}" class="active"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @forelse ($product->getMedia('product_attachments') as $key => $attachment)
                                        <div class="carousel-item active">
                                            <img class="d-block w-100 img" alt="{{ $attachment->getUrl('large') }}" src="{{ $attachment->getUrl('large') }}">
                                        </div>
                                    @empty
                                        <x-blank-section :url="'javascript:;'" :content="__('msgs.add', ['name' => __('product.attachment')])" />
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.product.attachments.store', ['product' => $product]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body mt-4">
                        @include('layouts.inc.errors-message')
                        <hr class="mt-4 mb-3 w-50">
                        <h3 class="mb-4 text-blue">{{ __('msgs.add', ['name' => __('product.attachments')]) }}</h3>
                        <div class="row row-cards">
                            <div class="col-12 col-md-6">
                                <x-input-label class="form-label" :value="__('msgs.photo')" />
                                <input type="file" class="form-control"name='image[]' multiple>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                                <path d="M14 19l2 2l4 -4"></path>
                                <path d="M9 8h4"></path>
                                <path d="M9 12h2"></path>
                            </svg>
                            {{ __('btns.submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header flex justify-content-between items-center">
                    <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
                </div>
                <table class="table card-table table-vcenter table-striped-columns">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('product.attachment') }}</th>
                            <th>{{ __('btns.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product->getMedia('product_attachments') as $key => $attachment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img width="100" src="{{ $attachment->getUrl('small') }}" class="img img-thumbnail">
                                </td>
                                <td>
                                    <div class="d-flex items-center gap-3">
                                        <form action="{{ route('admin.products.attachments.destroy', $attachment->id) }}" method="POST">
                                            @csrf
                                            <a href="{{ route('admin.products.attachments.destroy', $attachment->id) }}" class="bordered" title="{{ __('btns.delete') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7l16 0"></path>
                                                    <path d="M10 11l0 6"></path>
                                                    <path d="M14 11l0 6"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                </svg>
                                            </a>
                                        </form>
                                        <a href="{{ route('admin.products.attachments.download', $attachment->id) }}" title="{{ __('btns.download') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                <path d="M7 11l5 5l5 -5"></path>
                                                <path d="M12 4l0 12"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="card-footer border-top-0">
                </div>
            </div>
        </div>
    </div>
</x-master-layout>

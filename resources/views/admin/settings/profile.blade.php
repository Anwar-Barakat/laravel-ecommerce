<x-master-layout>
    @section('pageTitle', 'settings')

    @section('breadcrumbTitle', __('setting.settings'))

    @section('breadcrumbSubtitle', __('partials.home'))

    <div class="card">
        <div class="row g-0">
            @include('admin.settings.inc.sidebar')

            @livewire('admin.setting.admin-profile', ['admin' => Auth::guard('admin')->user()])
        </div>
    </div>
</x-master-layout>

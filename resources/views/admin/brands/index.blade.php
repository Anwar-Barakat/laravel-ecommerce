<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('section.sections')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('section.sections')]))
    @section('breadcrumbSubtitle', __('product.brands'))

    @livewire('admin.brand.display-brand')
</x-master-layout>

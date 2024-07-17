@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'All Fingerboard of The Year')
@section('content')

    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    All FoTY
                </h2>
            </div>
        </div>
    </div>
    @livewire('all-foty')

@endsection

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteFotyModal').modal('hide');
        });
    </script>
@endpush

@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'All Post')
@section('content')

<div class="page-header d-print-none">
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
            All Posts
            </h2>
        </div>
    </div>
</div>
@livewire('all-posts')

@endsection

@push('scripts')
<script>
    window.addEventListener('close-modal', event => {
        $('#deletePostModal').modal('hide');
    });
</script>
@endpush

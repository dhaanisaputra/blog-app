@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Authors')
@section('content')

@livewire('authors')

@endsection

@push('scripts')
    <script>
        $(window).on('hidden.bs.modal', function() {
            Livewire.dispatch('resetForms');
        });

        window.addEventListener('hide_add_author_modal', function(event){
            $('#add_author_modal').modal('hide');
        });

        window.addEventListener('showEditAuthorModal', function(event) {
            $('#edit_author_modal').modal('show');
        });

        window.addEventListener('hide_edit_author_modal', function(event){
            $('#edit_author_modal').modal('hide');
        });

    </script>
@endpush


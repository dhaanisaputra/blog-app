@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Categories')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Categories & Sub Categories
          </h2>
        </div>
      </div>
    </div>
</div>

@livewire('categories')

@endsection
@push('scripts')
    <script>
        window.addEventListener('hideCategoriesModal', function(e){
            $('#categories_modal').modal('hide');
        });

        window.addEventListener('showcategoriesModal', function(e){
            $('#categories_modal').modal('show');
        });

        window.addEventListener('hideSubCategoriesModal', function(e){
            $('#subcategories_modal').modal('hide');
        });

        window.addEventListener('showSubcategoriesModal', function(e){
            $('#subcategories_modal').modal('show');
        });

        $('#categories_modal, #subcategories_modal').on('hidden.bs.modal', function(e){
            Livewire.dispatch('resetModalForm');
        });

        window.addEventListener('close-modal', event => {
        $('#deleteCatModal').modal('hide');
        });

        window.addEventListener('close-modal-subCat', event => {
            $('#deleteSubCatModal').modal('hide');
        });

    </script>
@endpush


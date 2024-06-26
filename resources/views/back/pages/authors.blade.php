@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Authors')
@section('content')

@livewire('authors')

@endsection

@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

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

        window.addEventListener('close-modal', event => {
        $('#deleteModal').modal('hide');

        // window.addEventListener('deleteAuthor', function(event){
        //     Swal.fire({
        //         title:'Are You Sure ?',
        //         imageWidth:48,
        //         imageHeight:48,
        //         html:event.detail.html,
        //         showCloseButton:true,
        //         showCancelButton:true,
        //         cancelButtonText:'Cancel',
        //         confirmButtonText:'Yes, delete',
        //         cancelButtonColor:'#d33',
        //         confirmButtonColor:'#3085d6',
        //         width:300,
        //         allowOutsideClick:false
        //     }).then(function(result){
        //         if(result.value){
        //             Livewire.dispatch('deleteAuthorAction', event.detail.id);
        //         }
        //     });
        // });

        // window.addEventListener('deleteAuthor', function(){
        //     Livewire.on('deleteAuthor', data => {
        //         Swal.fire({
        //             title:data.title,
        //             imageWidth:48,
        //             imageHeight:48,
        //             html:data.html,
        //             showCloseButton:true,
        //             showCancelButton:true,
        //             cancelButtonText:'Cancel',
        //             confirmButtonText:'Yes, delete',
        //             cancelButtonColor:'#d33',
        //             confirmButtonColor:'#3085d6',
        //             width:300,
        //             allowOutsideClick:false
        //         }).then(function(result){
        //             if(result.value){
        //                 Livewire.dispatch('deleteAuthorAction', data.id);
        //             }
        //         });
        //     });
        // });

        // document.addEventListener('livewire:load', function () {
        //     Livewire.on('deleteAuthor', data => {
        //         Swal.fire({
        //             title: data.title,
        //             html: data.html,
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonText: 'Yes, delete it!',
        //             cancelButtonText: 'Cancel'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 Livewire.emit('confirmDeleteAuthor', data.id);
        //             }
        //         });
        //     });
        // });

        });
    </script>
@endpush


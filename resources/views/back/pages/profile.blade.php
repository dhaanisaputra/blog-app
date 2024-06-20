@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')

@livewire('author-profile-header')
<hr>
<div class="row">
    <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
              <a href="#tabs-detail" class="nav-link active" data-bs-toggle="tab">Personal Detail</a>
            </li>
            <li class="nav-item">
              <a href="#tabs-password" class="nav-link" data-bs-toggle="tab">Change Password</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="tabs-detail">
                    <div>
                        @livewire('author-personal-detail')
                    </div>
                </div>
                <div class="tab-pane" id="tabs-password">
                <div>
                    @livewire('author-change-password-form')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>
        $('#changeAuthorPictureFile').ijaboCropTool({
            preview : '.image-previewer',
            setRatio:1,
            allowedExtensions: ['jpg', 'jpeg','png'],
            buttonsText:['CROP','QUIT'],
            buttonsColor:['#30bf7d','#ee5155', -15],
            processUrl:'{{ route("author.change-profile-picture") }}',
            withCSRF:['_token','{{ csrf_token() }}'],
            onSuccess:function(message, element, status){
                // alert(message);
                Livewire.dispatch('updateAuthorProfileHeader');
                Livewire.dispatch('updateTopHeader');
                toastr.success(message);
            },
            onError:function(message, element, status){
            // alert(message);
            toastr.error(message);
            }
        });
    </script>
@endpush

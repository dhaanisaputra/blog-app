@extends('back.layout.auth-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Login')
@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-1">
            @php
                $getSetting = App\Models\Settings::getSingle();
            @endphp
            <a href="{{route('author.login')}}" class="navbar-brand navbar-brand-autodark"><img src="{{ url('/back/dist/img/logo-favicon/'.$getSetting->blog_favicon) }}" style="width: 200px;height: 200px;" alt=""></a>
            {{-- <label class="form-label">Yogyakarta Fingerboard Community</label> --}}
            <h2 class="h2 text-center mb-2">Yogyakarta Fingerboard Community</h2>
        </div>
        @livewire('author-login-form')
    </div>
  </div>

@endsection

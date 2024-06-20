@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Settings')
@section('content')

    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Settings
            </h2>
        </div>
    </div>

        <div class="card">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">General Settings</a>
              </li>
              <li class="nav-item" role="presentation">
                <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Logo & Favicon</a>
              </li>
              <li class="nav-item" role="presentation">
                <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Social Media</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="tabs-home-8" role="tabpanel">
                    <div>
                        @livewire('author-general-settings')
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Set Blog Logo</h3>
                            <form action="{{ route('author.change-blog-logo')}}" method="POST" id="changeBlogLogoForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" class="form-control" name="blog_logo">
                                </div>
                                {{-- @php
                                    $getSetting = App\Models\Settings::getSingle();
                                @endphp
                                @if (!empty($getSetting->getLogo()))
                                    <img src="{{ $getSetting->getLogo()}}" style="width: 200px;height: 200px;">
                                @endif --}}

                                @php
                                    $getSetting = App\Models\Settings::find(1);
                                @endphp
                                <img src="{{ url('/back/dist/img/logo-favicon/'.$getSetting->blog_logo) }}" style="width: 200px;height: 200px;">
                                <button type="submit" class="btn btn-primary">Change Logo</button>
                            </form>
                            {{-- <label>Logo <span style="color: red"></span></label>
                            <input type="file" class="form-control" name="blog_logo">
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Change Logo</button>
                            </div> --}}
                        </div>
                        <div class="col-md-6">
                            <h3>Set Blog Favicon</h3>
                            <form action="{{ route('author.change-blog-favicon')}}" method="POST" id="changeBlogFaviconForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" class="form-control" name="blog_favicon">
                                </div>
                                @php
                                    $getSetting = App\Models\Settings::find(1);
                                @endphp
                                <img src="{{ url('/back/dist/img/logo-favicon/'.$getSetting->blog_favicon) }}" style="width: 200px;height: 200px;">
                                <button type="submit" class="btn btn-primary">Change Favicon</button>
                            </form>
                            {{-- <label>Favicon Icon <span style="color: red"></span></label>
                            <input type="file" class="form-control" name="blog_favicon">
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Change Favicon</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
                    <div>
                        @livewire('author-blog-social-media-form')
                    </div>
                </div>
            </div>
          </div>
        </div>

@endsection

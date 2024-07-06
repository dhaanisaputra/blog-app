@if (all_tags() != null)
    @php
        $alltagsString = all_tags();
        $allTagsArray = explode(',', $alltagsString);
    @endphp
    <div class="aside-block">
        <h3 class="aside-title">Tags</h3>
        <ul class="aside-tags list-unstyled">
            @foreach (array_unique($allTagsArray) as $tag)
                <li><a href="{{ route('tag_posts', $tag) }}">#{{ $tag }}</a></li>
            @endforeach
        </ul>
    </div><!-- End Tags -->
@endif

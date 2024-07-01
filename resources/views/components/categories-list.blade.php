<div>
    @if (categories())
        <div class="col-lg-12 col-md-6">
            <div class="widget">
                <h2 class="section-title mb-3">Kategori</h2>
                <div class="widget-body">
                    <ul class="widget-list">
                        @include('front.layout.inc.categories_list')
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

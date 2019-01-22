@if(!empty($hotProducts))
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
            @include('product.partial._itemHotProduct')
        </div>
    </div>
@endif
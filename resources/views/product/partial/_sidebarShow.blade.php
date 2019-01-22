<div class='col-md-3 sidebar'>
    <div class="sidebar-module-container">
        @if(!empty($hotProducts))
            <div class="sidebar-widget hot-deals wow fadeInUp">
                @include('product.partial._itemHotProduct')
            </div>
        @endif

    <!-- ============================================== NEWSLETTER ============================================== -->
        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
            <h3 class="section-title">Newsletters</h3>
            <div class="sidebar-widget-body outer-top-xs">
                <p>Sign Up for Our Newsletter!</p>
                <form>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Subscribe to our newsletter">
                    </div>
                    <button class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>

        @if(!empty($comments))
            <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                <div id="advertisement" class="advertisement">
                    @foreach($comments as $comment)
                        <div class="item">
                            <div class="avatar"><img src="/img/156_156{{ $comment->avatar }}" alt="Image"></div>
                            <div class="testimonials"><em>"</em>{{ $comment->content }}<em>"</em></div>
                            <div class="clients_author">{{ $comment->name }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
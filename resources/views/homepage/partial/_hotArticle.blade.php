@if(!empty($hotArticle))
    <section class="section latest-blog outer-bottom-vs wow fadeInUp">
        <h3 class="section-title">Tin tức nổi bật</h3>
        <div class="blog-slider-container outer-top-xs">
            <div class="owl-carousel blog-slider custom-carousel">
                @foreach($hotArticle as $article)
                    <div class="item">
                        <div class="blog-post">
                            <div class="blog-post-image">
                                <div class="image">
                                    <a href="{{ $article->url }}">
                                        <img src="/img/535_275{{ $article->image }}" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="blog-post-info text-left">
                                <h3 class="name"><a href="{{ $article->url }}">{{ $article->name }}</a></h3>
                                <span class="info">{{ $article->created_at }}</span>
                                <p class="text">
                                    {{ $article->description }}
                                </p>
                                <a href="{{ $article->url }}" class="lnk btn btn-primary">Read more</a></div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endif
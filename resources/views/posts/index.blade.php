@extends('layouts.app')

@section('content')
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="/">Trang chủ</a></li>
					@if(isset($parentsCategory) && $parentsCategory)
						@foreach($parentsCategory as $breadcrumb)
							<li><a href="{{ setUrlByType($breadcrumb->type, $breadcrumb->slug) }}">{{ $breadcrumb->name }}</a></li>
						@endforeach
					@endif
					<li class='active'>{{ $category->name }}</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="body-content">
		<div class="container">
			<div class="row">
				<div class="blog-page">
					<div class="col-md-9">
						@if(isset($posts) && $posts)
							@foreach($posts as $post)
								<div class="@if($loop->first) blog-post wow fadeInUp @else blog-post outer-top-vs  wow fadeInUp @endif">
									<div class="row">
										<div class="col-md-4">
											<a href="{{ route('post.details', ['alias' => $post->slug]) }}">
												<img class="img-responsive" src="{{ $post->image }}" alt="">
											</a>
										</div>
										<div class="col-md-8">
											<h1><a href="{{ route('post.details', ['alias' => $post->slug]) }}">{{ $post->name }}</a></h1>
											<span class="date-time">{{ $post->created_at }}</span>
											<p>{{ $post->description }}</p>
										</div>
									</div>
								</div>
							@endforeach

							<div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

								<div class="text-right">
									<div class="pagination-container">
										{{ $posts->links() }}
									</div>
								</div>
							</div>
						@endif
					</div>
					<div class="col-md-3 sidebar">

						<div class="sidebar-module-container">
							<div class="home-banner outer-top-n outer-bottom-xs">
								<img src="{{ asset('images/banners/LHS-banner.jpg') }}" alt="Image">
							</div>

							@if(isset($groupHot) && count($groupHot->posts) > 0)
								<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
									<h3 class="section-title">Bài viết xem nhiều</h3>
									<div class="tab-content" style="padding-left:0">
										<div class="tab-pane active m-t-20" id="popular">
											@foreach($groupHot->posts as $popular)
												<div class="@if($loop->first) blog-post inner-bottom-30 @else blog-post @endif" >
													<img class="img-responsive" src="{{ $popular->image }}" alt="">
													<h4><a href="{{ setUrlByType($popular->type, $popular->slug) }}">{{ $popular->name }}</a></h4>
													<span class="date-time">{{ $popular->created_at }}</span>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
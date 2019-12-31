@section('title', $category->meta_title ? $category->meta_title : $category->name)

@section('description', $category->meta_description ? $category->meta_description : $category->description)

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
						@if(!empty($articles))
							@foreach($articles as $article)
								<div class="@if($loop->first) blog-post wow fadeInUp @else blog-post outer-top-vs  wow fadeInUp @endif">
									<div class="row">
										<div class="col-md-4">
											<a href="{{ $article->url }}">
												<img class="img-responsive" src="{{ $article->image }}" alt="">
											</a>
										</div>
										<div class="col-md-8">
											<h1><a href="{{ $article->url }}">{{ $article->name }}</a></h1>
											<span class="date-time">{{ $article->created_at }}</span>
											<p>{{ $article->description }}</p>
										</div>
									</div>
								</div>
							@endforeach

							<div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

								<div class="text-right">
									<div class="pagination-container">
										{{ $articles->links() }}
									</div>
								</div>
							</div>
						@endif
					</div>
					<div class="col-md-3 sidebar">

						<div class="sidebar-module-container">
							<div class="sidebar-filter">
								<div class="sidebar-widget sidebar-menu wow fadeInUp">
									<h3 class="section-title">Danh mục sản phẩm</h3>
									<div class="sidebar-widget-body">
										@if(!empty($mainMenu))
											<div class="accordion">
												@foreach($mainMenu as $itemMainMenu)
													<div class="accordion-group">
														<div class="accordion-heading">
															@if(!empty($itemMainMenu['child']))
																<a href="#collapse{{ $itemMainMenu['id'] }}" data-toggle="collapse"
																   class="accordion-toggle collapsed">
																	{{ $itemMainMenu['name'] }}
																</a>
															@else
																<a href="{{ $itemMainMenu['url'] }}">
																	{{ $itemMainMenu['name'] }}
																</a>
															@endif
														</div>
														@if(!empty($itemMainMenu['child']))
															<div class="accordion-body collapse"
																 id="collapse{{ $itemMainMenu['id'] }}">
																<div class="accordion-inner">
																	<ul>
																		@foreach($itemMainMenu['child'] as $itemChild)
																			<li>
																				@if(!empty($itemChild['grand']))
																					<div class="accordion-heading">
																						<a href="#collapse{{ $itemChild['id'] }}"
																						   data-toggle="collapse"
																						   class="accordion-toggle collapsed">
																							{{ $itemChild['name'] }}
																						</a>
																					</div>
																					<div class="accordion-body collapse"
																						 id="collapse{{ $itemChild['id'] }}">
																						<div class="accordion-inner">
																							<ul>
																								@foreach($itemChild['grand'] as $itemGrand)
																									<li>
																										<a href="{{ $itemGrand['url'] }}">{{ $itemGrand['name'] }}</a>
																									</li>
																								@endforeach
																							</ul>
																						</div>
																					</div>
																				@else
																					<a href="{{ $itemChild['url'] }}">{{ $itemChild['name'] }}</a>
																				@endif
																			</li>
																		@endforeach
																	</ul>
																</div>
															</div>
														@endif
													</div>
												@endforeach
											</div>
										@endif
									</div>
									<!-- /.sidebar-widget-body -->
								</div>
								<!-- /.sidebar-widget -->
								<!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

							</div>
							<!-- /.sidebar-filter -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
<footer id="footer" class="footer color-bg">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Liên hệ với chúng tôi</h4>
                    </div>

                    <div class="module-body">
                        <ul class="toggle-footer" style="">
                            <li class="media">
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body">
                                    <p>{{ isset($option['main_office']) ? $option['main_office'] : '' }}</p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body">
                                    <span>{{ isset($option['hotline']) ? $option['hotline'] : '' }}</span>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body">
                                    <span>
                                        <a href="mailto:{{ isset($option['email']) ? $option['email'] : '' }}">
                                            {{ isset($option['email']) ? $option['email'] : '' }}
                                        </a>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>

                @if(!empty($footerMenu))
                    @foreach($footerMenu as $itemFooterMenu)
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="module-heading">
                                <h4 class="module-title">{{ $itemFooterMenu['name'] }}</h4>
                            </div>

                            <div class="module-body">
                                @if(!empty($itemFooterMenu['child']))
                                    <ul class='list-unstyled'>
                                        @foreach($itemFooterMenu['child'] as $itemFooterChild)
                                            <li class="{{ $loop->first ? "first" : ($loop->last ? "last" : "") }}">
                                                <a href="{{ $itemFooterChild['url'] }}">{{ $itemFooterChild['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding social">
                <ul class="link">
                    <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
                    <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
                    <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 text-right copyright-text">
                Copyright by @hungnv
            </div>
        </div>
    </div>
</footer>
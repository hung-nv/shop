<div class='col-md-3 sidebar'>
    <div class="sidebar-module-container">
        <div class="sidebar-filter">
            <div class="sidebar-widget sidebar-menu wow fadeInUp">
                <h3 class="section-title">shop by</h3>
                <div class="widget-header">
                    <h4 class="widget-title">Category</h4>
                </div>
                <div class="sidebar-widget-body">
                    @if(!empty($mainMenu))
                        <div class="accordion">
                            @foreach($mainMenu as $itemMainMenu)
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        @if(!empty($itemMainMenu['child']))
                                            <a href="#collapse{{ $itemMainMenu['id'] }}" data-toggle="collapse"
                                               class="accordion-toggle @if(!in_array($itemMainMenu['id'], $menuActive)) collapsed @else active @endif">
                                                {{ $itemMainMenu['name'] }}
                                            </a>
                                        @else
                                            <a href="{{ $itemMainMenu['url'] }}">
                                                {{ $itemMainMenu['name'] }}
                                            </a>
                                        @endif
                                    </div>
                                    @if(!empty($itemMainMenu['child']))
                                        <div class="accordion-body collapse @if(in_array($itemMainMenu['id'], $menuActive)) in @endif"
                                             id="collapse{{ $itemMainMenu['id'] }}">
                                            <div class="accordion-inner">
                                                <ul>
                                                    @foreach($itemMainMenu['child'] as $itemChild)
                                                        <li>
                                                            @if(!empty($itemChild['grand']))
                                                                <div class="accordion-heading">
                                                                    <a href="#collapse{{ $itemChild['id'] }}"
                                                                       data-toggle="collapse"
                                                                       class="accordion-toggle @if(!in_array($itemChild['id'], $menuActive)) collapsed @else active @endif">
                                                                        {{ $itemChild['name'] }}
                                                                    </a>
                                                                </div>
                                                                <div class="accordion-body collapse @if(in_array($itemChild['id'], $menuActive)) in @endif"
                                                                     id="collapse{{ $itemChild['id'] }}">
                                                                    <div class="accordion-inner">
                                                                        <ul>
                                                                            @foreach($itemChild['grand'] as $itemGrand)
                                                                                <li>
                                                                                    <a @if(in_array($itemGrand['id'], $menuActive)) class="active" @endif href="{{ $itemGrand['url'] }}">{{ $itemGrand['name'] }}</a>
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

            <!-- ============================================== PRICE SILDER============================================== -->
            <div class="sidebar-widget wow fadeInUp">
                <div class="widget-header">
                    <h4 class="widget-title">Price Slider</h4>
                </div>
                <div class="sidebar-widget-body m-t-10">
                    <div class="price-range-holder"><span class="min-max"> <span class="pull-left">$200.00</span> <span
                                    class="pull-right">$800.00</span> </span>
                        <input type="text" id="amount"
                               style="border:0; color:#666666; font-weight:bold;text-align:center;">
                        <input type="text" class="price-slider" value="">
                    </div>
                    <!-- /.price-range-holder -->
                    <a href="#" class="lnk btn btn-primary">Show Now</a></div>
                <!-- /.sidebar-widget-body -->
            </div>
            <!-- /.sidebar-widget -->

        </div>
        <!-- /.sidebar-filter -->
    </div>
    <!-- /.sidebar-module-container -->
</div>
@if(isset($mainMenu) && $mainMenu)
    <ul class="nav navbar-nav">
        <li class="dropdown"><a href="/">Home</a></li>
        @foreach($mainMenu as $itemMainMenu)
            @if(getLevel($itemMainMenu) == 3)
                <li class="dropdown yamm mega-menu">
                    <a href="{{ $itemMainMenu['url'] }}" data-hover="dropdown" class="dropdown-toggle"
                       data-toggle="dropdown">{{ $itemMainMenu['name'] }}</a>
                    <ul class="dropdown-menu container">
                        <li>
                            <div class="yamm-content ">
                                <div class="row">
                                    @foreach($itemMainMenu['child'] as $itemChild)
                                        <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                            <h2 class="title">{{ $itemChild['name'] }}</h2>
                                            @if(!empty($itemChild['grand']))
                                                <ul class="links">
                                                    @foreach($itemChild['grand'] as $grand)
                                                        <li><a href="{{ $grand['url'] }}">{{ $grand['name'] }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif`
                                        </div>
                                    @endforeach

                                    {{--<div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">--}}
                                        {{--<img class="img-responsive"--}}
                                             {{--src="{{ asset('images/banners/top-menu-banner.jpg') }}">--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            @elseif(getLevel($itemMainMenu) == 2)
                <li class="dropdown">
                    <a href="{{ $itemMainMenu['url'] }}" class="dropdown-toggle" data-hover="dropdown"
                       data-toggle="dropdown">{{ $itemMainMenu['name'] }}</a>
                    <ul class="dropdown-menu pages">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-xs-12 col-menu">
                                        <ul class="links">
                                            @foreach($itemMainMenu['child'] as $itemMenuChild)
                                                <li>
                                                    <a href="{{ $itemMenuChild['url'] }}">
                                                        {{ $itemMenuChild['name'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            @else
                <li class="dropdown">
                    <a href="{{ $itemMainMenu['url'] }}">{{ $itemMainMenu['name'] }}</a>
                </li>
            @endif
        @endforeach
    </ul>
@endif
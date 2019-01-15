@if(isset($mainMenu) && $mainMenu)
    <ul class="nav navbar-nav">
        <li class="dropdown"><a href="/">Home</a></li>
        @foreach($mainMenu as $itemMainMenu)
            @if(isset($itemMainMenu['child']) && $itemMainMenu['child'])
                <li class="dropdown">
                    <a href="@if($itemMainMenu['prefix'])/{{ $itemMainMenu['prefix'] }}@endif/{{ $itemMainMenu['slug'] }}" class="dropdown-toggle" data-hover="dropdown"
                       data-toggle="dropdown">{{ $itemMainMenu['name'] }}</a>
                    <ul class="dropdown-menu pages">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-xs-12 col-menu">
                                        <ul class="links">
                                            @foreach($itemMainMenu['child'] as $itemMenuChild)
                                                <li>
                                                    <a href="@if($itemMenuChild['prefix'])/{{ $itemMenuChild['prefix'] }}@endif/{{ $itemMenuChild['slug'] }}">
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
                    <a href="@if($itemMainMenu['prefix'])/{{ $itemMainMenu['prefix'] }}@endif/{{ $itemMainMenu['slug'] }}">{{ $itemMainMenu['name'] }}</a>
                </li>
            @endif
        @endforeach
    </ul>
@endif
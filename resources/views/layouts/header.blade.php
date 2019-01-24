<header class="header-style-1" id="header">

    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    @if(!empty($topMenu))
                        <ul class="list-unstyled">
                            @foreach($topMenu as $itemTopMenu)
                                <li><a href="{{ $itemTopMenu['url'] }}">{{ $itemTopMenu['name'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"><a href="home.html"> <img src="{{ asset('images/logo.png') }}" alt="logo"> </a>
                    </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <div class="control-group">
                            <ul class="categories-filter animate-dropdown">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">
                                        @{{ nameCatalog }}
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="menu-header">
                                            <a data-id="-1" data-name="All" v-on:click="onClickSelectCatalog">All
                                                Categories</a>
                                        </li>
                                        @if(!empty($menuCatalogs))
                                            @foreach($menuCatalogs as $itemCatalog)
                                                <li class="menu-header">
                                                    <a data-id="{{ $itemCatalog['id'] }}"
                                                       data-name="{{ $itemCatalog['name'] }}"
                                                       v-on:click="onClickSelectCatalog">{{ $itemCatalog['name'] }}</a>
                                                </li>
                                                @if(!empty($itemCatalog['child']))
                                                    @foreach($itemCatalog['child'] as $childCatalog)
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1"
                                                               v-on:click="onClickSelectCatalog"
                                                               data-id="{{ $childCatalog['id'] }}"
                                                               data-name="{{ $childCatalog['name'] }}">- {{ $childCatalog['name'] }}</a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                            <input class="search-field" placeholder="Tìm kiếm..." v-model="textSearch"/>
                            <a class="search-button" v-on:click="submitSearchForm"></a></div>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">

                    <div class="dropdown dropdown-cart"><a href="#" class="dropdown-toggle lnk-cart"
                                                           data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"><i class="glyphicon glyphicon-shopping-cart"></i></div>
                                <div class="basket-item-count"><span class="count"><template>@{{ productsInCart.length }}</template></span>
                                </div>
                                <div class="total-price-basket">
                                    <span class="lbl">Giỏ hàng</span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="cart-item product-summary">
                                    <template v-for="(product, index) in productsInCart">
                                        <div class="row" :class="(index > 0) ? 'm-t-10' : ''">
                                            <div class="col-xs-4">
                                                <div class="image">
                                                    <img :src="'/img/46_46' + product.thumb" alt="">
                                                </div>
                                            </div>
                                            <div class="col-xs-8">
                                                <h3 class="name">@{{ product.name }}</h3>
                                                <div class="price">@{{ reFormatPrice(product.price) }}</div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>
                                <div class="clearfix cart-total">
                                    <div class="pull-right">
                                        <span class="text">Tổng tiền :</span>
                                        <span class='price'>@{{ getTotalMoney(productsInCart) }}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('checkout') }}"
                                       class="btn btn-upper btn-primary btn-block m-t-20">Thanh toán</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span></button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            @include('layouts._menu')

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
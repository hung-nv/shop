<div class="checkout-box">
    <div class="panel-group checkout-steps" id="accordion">
        @if(!empty($option['how_to_buy']))
            <div class="panel panel-default checkout-step-02">
                <div class="panel-heading">
                    <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                            <span>1</span>Hướng dẫn mua hàng
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body">
                        {!! str_replace("\r", "<br />", $option['how_to_buy']) !!}
                    </div>
                </div>
            </div>
        @endif

        @if(!empty($option['baohanh']))
            <div class="panel panel-default checkout-step-03">
                <div class="panel-heading">
                    <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
                            <span>2</span>Bảo hành sản phẩm
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        {!! str_replace("\r", "<br />", $option['baohanh']) !!}
                    </div>
                </div>
            </div>
        @endif

        @if(!empty($option['how_to_ship']))
            <div class="panel panel-default checkout-step-04">
                <div class="panel-heading">
                    <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFour">
                            <span>3</span>
                            Hình thức vận chuyển
                        </a>
                    </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse">
                    <div class="panel-body">
                        {!! str_replace("\r", "<br />", $option['how_to_ship']) !!}
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
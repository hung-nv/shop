<div class="col-md-4 col-sm-12 estimate-ship-tax">
    <table class="table">
        <thead>
        <tr>
            <th>
                <span class="estimate-title">Nhập mã giảm giá</span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control unicase-form-control text-input"
                           placeholder="Mã giảm giá.." v-model="couponCode">
                </div>
                <template v-if="!isCoupon">
                    <div class="form-group">
                        <span class="text-danger">Mã Khuyến mại không đúng hoặc đã hết thời gian sử dụng!</span>
                    </div>
                </template>
                <div class="clearfix pull-right">
                    <button type="button" class="btn-upper btn btn-primary"
                            v-on:click="checkCouponCode">
                        APPLY COUPON
                    </button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
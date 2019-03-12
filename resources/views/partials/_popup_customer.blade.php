<div class="modal fade modal-crawl-information" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nhận khuyến mại!!!</h4>
            </div>
            <div class="modal-body">
                <p>Vui lòng để lại thông tin để nhận được những khuyến mại mới nhất, coupon giảm giá siêu khủng lên tới 30%.</p>
                <form id="frm-crawl-information" role="form" method="post">
                    <div class="form-group">
                        <label class="control-label">Họ tên:</label>
                        <input type="text" class="form-control" name="name" v-model="name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email:</label>
                        <input type="email" class="form-control" name="email" v-model="email">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Số điện thoại:</label>
                        <input type="text" class="form-control" name="mobile" v-model="telephone">
                    </div>
                </form>
                <template v-if="errorMessage">
                    <p class="text-danger">@{{ errorMessage }}</p>
                </template>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">GỬI SAU</button>
                <button type="button" class="btn btn-primary" v-on:click="saveCustomer">GỬI THÔNG TIN</button>
            </div>
        </div>
    </div>
</div>
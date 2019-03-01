<div class="col-md-4 col-sm-12 estimate-ship-tax">
    <table class="table">
        <thead>
        <tr>
            <th>
                <span class="estimate-title">Nhập thông tin</span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div class="form-group">
                    <label class="info-title control-label">Họ tên <span>*</span></label>
                    <input class="form-control unicase-form-control text-input" name="name" v-model="name"/>
                </div>
                <div class="form-group">
                    <label class="info-title control-label">Số điện thoại <span>*</span></label>
                    <input class="form-control unicase-form-control text-input" name="telephone" v-model="telephone"/>
                </div>
                <div class="form-group">
                    <label class="info-title control-label">Địa chỉ <span>*</span></label>
                    <input class="form-control unicase-form-control text-input" name="address" v-model="address" required/>
                </div>
                <div class="form-group">
                    <label class="info-title control-label">Ghi chú</label>
                    <textarea class="form-control unicase-form-control" name="note" v-model="note"></textarea>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
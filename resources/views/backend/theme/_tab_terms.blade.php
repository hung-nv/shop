<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Hướng dẫn mua hàng</label>
        <div class="col-md-5">
            <textarea class="form-control maxlength-handler" rows="8"
                      name="how_to_buy">{{ isset($option['how_to_buy']) ? $option['how_to_buy'] : old('how_to_buy') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Bảo hành sản phẩm</label>
        <div class="col-md-5">
            <textarea class="form-control maxlength-handler" rows="8"
                      name="baohanh">{{ isset($option['baohanh']) ? $option['baohanh'] : old('baohanh') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Hình thức vận chuyển</label>
        <div class="col-md-5">
            <textarea class="form-control maxlength-handler" rows="8"
                      name="how_to_ship">{{ isset($option['how_to_ship']) ? $option['how_to_ship'] : old('how_to_ship') }}</textarea>
        </div>
    </div>
</div>
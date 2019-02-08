<div class="form-group">
    <label class="control-label col-md-3">Sale off</label>
    <div class="col-md-5">
        <input type="number" name="value" value="{{ isset($couponCode) ? $couponCode['value'] : old('value') }}"
               class="form-control" placeholder="Sale ? %" required/>
    </div>
</div>

<div class="form-group last">
    <label class="control-label col-md-3">Start Time</label>
    <div class="col-md-5">
        <input name="dates" value="" class="form-control">
    </div>
</div>
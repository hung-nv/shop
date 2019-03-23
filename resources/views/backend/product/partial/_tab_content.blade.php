<div class="form-body">
    <div class="form-group hidden">
        <label class="col-md-2 control-label">
            Special
        </label>
        <div class="col-md-8">
            <textarea name="special" class="form-control" rows="4">{{ isset($product) ? $product['special'] : old('special') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">
            Description
            <span class="required"> * </span>
        </label>
        <div class="col-md-8">
            <textarea name="description" class="form-control" rows="4">{{ isset($product) ? $product['description'] : old('description') }}</textarea>
        </div>
    </div>

    <div class="form-group last">
        <label class="col-md-2 control-label">
            Content
            <span class="required"> * </span>
        </label>
        <div class="col-md-8">
            <textarea class="ckeditor form-control" name="content" rows="6"
                      data-error-container="#editor2_error">{{ isset($product) ? $product['content'] : old('content') }}</textarea>
            <div id="editor2_error"></div>
        </div>
    </div>
</div>
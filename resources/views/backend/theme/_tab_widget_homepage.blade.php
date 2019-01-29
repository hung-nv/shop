<div class="form-body">
    <h3 class="form-section-setting no-margin-top">Banner Info</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Image 1</label>
                    <div class="col-md-9">
                        @if(!empty($option['banner_image_1']))
                            <input type="hidden" name="old_banner_image_1" id="old_banner_image_1" data-id=""
                                   value="{{ $option['banner_image_1'] }}">
                        @endif
                        <input id="banner_image_1" name="banner_image_1" type="file" data-show-upload="false">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Link 1</label>
                    <div class="col-md-9">
                        <input name="banner_link_1" type="url" class="form-control"
                               value="{{ isset($option['banner_link_1']) ? $option['banner_link_1'] : old('banner_link_1') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Text Line 1</label>
                    <div class="col-md-9">
                        <input name="banner_1_text_line_1" type="url" class="form-control"
                               value="{{ isset($option['banner_1_text_line_1']) ? $option['banner_1_text_line_1'] : old('banner_1_text_line_1') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Text Line 2</label>
                    <div class="col-md-9">
                        <input name="banner_1_text_line_2" type="url" class="form-control"
                               value="{{ isset($option['banner_1_text_line_2']) ? $option['banner_1_text_line_2'] : old('banner_1_text_line_2') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Text Line 3</label>
                    <div class="col-md-9">
                        <input name="banner_1_text_line_3" type="url" class="form-control"
                               value="{{ isset($option['banner_1_text_line_3']) ? $option['banner_1_text_line_3'] : old('banner_1_text_line_3') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Image 2</label>
                    <div class="col-md-9">
                        @if(!empty($option['banner_image_2']))
                            <input type="hidden" name="old_banner_image_2" id="old_banner_image_2" data-id=""
                                   value="{{ $option['banner_image_2'] }}">
                        @endif
                        <input id="banner_image_2" name="banner_image_2" type="file" data-show-upload="false">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Link 2</label>
                    <div class="col-md-9">
                        <input name="banner_link_2" type="url" class="form-control"
                               value="{{ isset($option['banner_link_2']) ? $option['banner_link_2'] : old('banner_link_2') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Text Line 1</label>
                    <div class="col-md-9">
                        <input name="banner_2_text_line_1" type="url" class="form-control"
                               value="{{ isset($option['banner_2_text_line_1']) ? $option['banner_2_text_line_1'] : old('banner_2_text_line_1') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Text Line 2</label>
                    <div class="col-md-9">
                        <input name="banner_2_text_line_2" type="url" class="form-control"
                               value="{{ isset($option['banner_2_text_line_2']) ? $option['banner_2_text_line_2'] : old('banner_2_text_line_2') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Text Line 3</label>
                    <div class="col-md-9">
                        <input name="banner_2_text_line_3" type="url" class="form-control"
                               value="{{ isset($option['banner_2_text_line_3']) ? $option['banner_2_text_line_3'] : old('banner_2_text_line_3') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3 class="form-section-setting">Special Info</h3>

    <div class="form-group">
        <label class="col-md-2 control-label">Special 1: Line 1</label>
        <div class="col-md-5">
            <input type="text" class="form-control maxlength-handler" name="special_1_line_1" maxlength="150"
                   value="{{ isset($option['special_1_line_1']) ? $option['special_1_line_1'] : old('special_1_line_1') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Special 1: Line 2</label>
        <div class="col-md-5">
            <input type="text" class="form-control maxlength-handler" name="special_1_line_2" maxlength="150"
                   value="{{ isset($option['special_1_line_2']) ? $option['special_1_line_2'] : old('special_1_line_2') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Special 2: Line 1</label>
        <div class="col-md-5">
            <input type="text" class="form-control maxlength-handler" name="special_2_line_1" maxlength="150"
                   value="{{ isset($option['special_2_line_1']) ? $option['special_2_line_1'] : old('special_2_line_1') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Special 2: Line 2</label>
        <div class="col-md-5">
            <input type="text" class="form-control maxlength-handler" name="special_2_line_2" maxlength="150"
                   value="{{ isset($option['special_2_line_2']) ? $option['special_2_line_2'] : old('special_2_line_2') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Special 3: Line 1</label>
        <div class="col-md-5">
            <input type="text" class="form-control maxlength-handler" name="special_3_line_1" maxlength="150"
                   value="{{ isset($option['special_3_line_1']) ? $option['special_3_line_1'] : old('special_3_line_1') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Special 3: Line 2</label>
        <div class="col-md-5">
            <input type="text" class="form-control maxlength-handler" name="special_3_line_2" maxlength="150"
                   value="{{ isset($option['special_3_line_2']) ? $option['special_3_line_2'] : old('special_3_line_2') }}">
        </div>
    </div>
</div>
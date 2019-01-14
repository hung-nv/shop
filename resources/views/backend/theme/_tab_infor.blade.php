<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Hotline</label>
        <div class="col-md-5">
            <input name="hotline" class="form-control"
                   value="{{ isset($option['hotline']) ? $option['hotline'] : old('hotline') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Email</label>
        <div class="col-md-5">
            <input type="email" name="email" class="form-control"
                   value="{{ isset($option['email']) ? $option['email'] : old('email') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Company Name</label>
        <div class="col-md-5">
            <input name="company_name" class="form-control"
                   value="{{ isset($option['company_name']) ? $option['company_name'] :  old('company_name') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Company Description</label>
        <div class="col-md-5">
        <textarea name="company_description" class="form-control"
                  rows="4">{{ isset($option['company_description']) ? $option['company_description'] : old('company_description') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Google Map Url</label>
        <div class="col-md-5">
        <textarea name="google_map" class="form-control"
                  rows="4">{{ isset($option['google_map']) ? $option['google_map'] : old('google_map') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Company Logo</label>
        <div class="col-md-5">
            @if(isset($option['company_logo']) && $option['company_logo'])
                <input type="hidden" name="old_company_logo" id="old_company_logo" data-id=""
                       value="{{ $option['company_logo'] }}">
            @endif
            <input id="company_logo" name="company_logo" type="file" data-show-upload="false">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Main office address</label>
        <div class="col-md-5">
            <input name="main_office" class="form-control"
                   value="{{ isset($option['main_office']) ? $option['main_office'] : old('main_office') }}"/>
        </div>
    </div>
</div>
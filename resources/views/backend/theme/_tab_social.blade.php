<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Fanpage Url</label>
        <div class="col-md-5">
            <input name="fanpage" class="form-control"
                   value="{{ isset($option['fanpage']) ? $option['fanpage'] : old('fanpage') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Youtube Channel Url</label>
        <div class="col-md-5">
            <input name="youtube" class="form-control"
                   value="{{ isset($option['youtube']) ? $option['youtube'] : old('youtube') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Google Analytic ID</label>
        <div class="col-md-5">
            <input name="google_analytics_id" class="form-control"
                   value="{{ isset($option['google_analytics_id']) ? $option['google_analytics_id'] : old('google_analytics_id') }}"/>
        </div>
    </div>
</div>
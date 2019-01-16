<div class="form-body">

    <div class="form-group">
        <label class="control-label col-md-3">Name</label>
        <div class="col-md-4">
            <input type="text" name="name" class="form-control"
                   value="{{ isset($data) ? $data['name'] : old('name') }}" required/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Type</label>
        <div class="col-md-4">
            <select class="form-control" v-model="adType" name="type" required>
                <option>Select...</option>
                <option value="1">Script</option>
                <option value="2">Image</option>
            </select>
        </div>
    </div>

    <div class="form-group" v-show="adType == '1'">
        <label class="control-label col-md-3">Script</label>
        <div class="col-md-4">
            <textarea name="script" type="text" rows="10"
                      class="form-control">{{ isset($data) ? $data['content'] : old('content') }}</textarea>
        </div>
    </div>

    <div class="form-group" v-show="adType == '2'">
        <label class="control-label col-md-3">Image</label>

        <div class="col-md-4">
            @if(isset($data) && $data['content'] && $data['type'] == '2')
                <input type="hidden" name="old_image" id="old-image" data-id="{{ $data['id'] }}"
                       value="{{ $data['content'] }}">
            @endif
            <input id="image" name="image" type="file" data-show-upload="false">
        </div>
    </div>

    <div class="form-group" v-show="adType == '2'">
        <label class="control-label col-md-3">Group</label>
        <div class="col-md-4">
            <select class="form-control" name="group">
                <option value="{{ config('const.advertising_group.partner') }}">Partners</option>
            </select>
        </div>
    </div>
</div>
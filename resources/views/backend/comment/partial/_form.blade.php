<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3">Name</label>
        <div class="col-md-4">
            <input name="name" id="name" type="text" class="form-control"
                   placeholder="Enter name" value="{{ isset($data) ? $data['name'] : old('name') }}" required></div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Avatar</label>
        <div class="col-md-4">
            @if(isset($data) && $data['avatar'])
                <input type="hidden" name="old_image" id="old-image" data-id="{{ $data['id'] }}"
                       value="{{ $data['avatar'] }}">
            @endif
            <input id="image" name="avatar" type="file" data-show-upload="false">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Content</label>
        <div class="col-md-4">
            <textarea class="form-control" rows="8"
                      name="content">{{ isset($data) ? $data['content'] : old('content') }}</textarea>
        </div>
    </div>
</div>
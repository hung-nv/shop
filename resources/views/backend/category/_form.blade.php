<div class="form-group">
    <label class="control-label col-md-3">Name</label>
    <div class="col-md-9">
        <input name="name" v-model="categoryName" value="{{ isset($category) ? $category['name'] : old('name') }}"
               class="form-control" placeholder="Enter your category name" required/>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Slug</label>
    <div class="col-md-9">
        <input name="slug" :value="categorySlug" class="form-control"
               placeholder="Enter your category slug"></div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Parent</label>
    <div class="col-md-9">
        <select class="form-control" name="parent_id">
            <option value="">Select...</option>
            {!! $templateCategory !!}
        </select>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputFile" class="col-md-3 control-label">Image</label>
    <div class="col-md-9">
        @if(isset($category) && $category['image'])
            <input type="hidden" name="old_image" id="old-image" data-id="{{ $category['id'] }}"
                   value="{{ isset($category) ? $category['image'] : '' }}">
        @endif
        <input id="image" name="image" type="file" data-show-upload="false">
    </div>
</div>

<input type="hidden" name="type" value="category">

<div class="form-group">
    <label class="control-label col-md-3">Meta title</label>
    <div class="col-md-9">
        <input type="text" value="{{ isset($category) ? $category['meta_title'] : old('meta_title') }}"
               name="meta_title" class="form-control"></div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Meta description</label>
    <div class="col-md-9">
        <input value="{{ isset($category) ? $category['meta_description'] : old('meta_description') }}"
               name="meta_description" class="form-control"></div>
</div>

<?php $status = isset($category) ? $category['status'] : (old('status') ? old('status') : 1) ?>
<div class="form-group last">
    <label class="control-label col-md-3">Status</label>
    <div class="col-md-9">
        <select class="form-control" name="status">
            <option value="0" @if($status === 0) selected @endif>No</option>
            <option value="1" @if($status === 1) selected @endif>Approved</option>
        </select>
    </div>
</div>
<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Site Heading</label>
        <div class="col-md-5">
            <input name="site_heading" class="form-control"
                   value="{{ isset($option['site_heading']) ? $option['site_heading'] : old('site_heading') }}"/>
        </div>
    </div>

    <?php $homepage_post_id = isset($option['homepage_post_id']) ? $option['homepage_post_id'] : old('homepage_post_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Set Homepage</label>
        <div class="col-md-5">
            <select class="form-control" name="homepage_post_id">
                <option value="">Select Landing Page...</option>
                @if(isset($pages) && $pages)
                    @foreach($pages as $page)
                        <option value="{{ $page['id'] }}"
                                @if($homepage_post_id == $page['id']) selected @endif>{{ $page['name'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <?php $mainMenuId = isset($option['main_menu_id']) ? $option['main_menu_id'] : old('main_menu_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Main Menu</label>
        <div class="col-md-5">
            <select class="form-control" name="main_menu_id">
                <option value="">Select Menu...</option>
                @foreach($menus as $mainMenu)
                    <option value="{{ $mainMenu->id }}"
                            @if($mainMenu->id == $mainMenuId) selected @endif>{{ $mainMenu->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <?php $topMenuId = isset($option['top_menu_id']) ? $option['top_menu_id'] : old('top_menu_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Top Menu</label>
        <div class="col-md-5">
            <select class="form-control" name="top_menu_id">
                <option value="">Select Menu...</option>
                @foreach($menus as $topMenu)
                    <option value="{{ $topMenu->id }}"
                            @if($topMenu->id == $topMenuId) selected @endif>{{ $topMenu->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <?php $bottomMenuId = isset($option['footer_menu_id']) ? $option['footer_menu_id'] : old('footer_menu_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Footer Menu</label>
        <div class="col-md-5">
            <select class="form-control" name="footer_menu_id">
                <option value="">Select Menu...</option>
                @foreach($menus as $subMenu)
                    <option value="{{ $subMenu->id }}"
                            @if($subMenu->id == $bottomMenuId) selected @endif>{{ $subMenu->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Main Catalog on Index</label>
        <div class="col-md-5">
            <div class="form-control height-auto">
                <div class="scroller" style="height:275px;"
                     data-always-visible="1">
                    <div class="mt-checkbox-list"
                         data-error-container="#form_2_services_error">
                        {!! $templateCategory !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">New Catalog on Index</label>
        <div class="col-md-5">
            <div class="form-control height-auto">
                <div class="scroller" style="height:275px;"
                     data-always-visible="1">
                    <div class="mt-checkbox-list"
                         data-error-container="#form_2_services_error">
                        {!! $templateSubCategory !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Favico</label>
        <div class="col-md-5">
            @if(isset($option['favico']) && $option['favico'])
                <input type="hidden" name="old_favico" id="old_favico" data-id=""
                       value="{{ isset($option) ? $option['favico'] : '' }}">
            @endif
            <input id="favico" name="favico" type="file" data-show-upload="false">
        </div>
    </div>
</div>
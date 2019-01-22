<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SettingRequest;
use App\Models\Category;
use App\Services\Common\ImageServices;
use App\Services\MenuServices;
use App\Services\OptionServices;
use App\Services\ArticleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    protected $image, $menuServices, $optionServices, $postServices;

    public function __construct(
        ImageServices $imageServices,
        MenuServices $menuServices,
        OptionServices $optionServices,
        ArticleServices $postServices
    )
    {
        parent::__construct();

        $this->image = $imageServices;

        $this->menuServices = $menuServices;

        $this->optionServices = $optionServices;

        $this->postServices = $postServices;
    }

    /**
     * Setting menu.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function menu(Request $request)
    {
        $idGroup = $request->menu_group;

        $data = $this->menuServices->getDataMenu($this->pageType, $idGroup);

        $templateCategory = $this->menuServices->getCheckboxAllCategory(
            $request->old('parent')
        );

        return view('backend.menu.index', [
            'templateCategory' => $templateCategory,
            'pages' => $data['pages'],
            'templateMenu' => $data['templateMenu'],
            'menuGroups' => $data['menuGroups'],
            'idGroup' => $idGroup
        ]);
    }

    /**
     * Page index setting.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $dataSetting = $this->optionServices->getDataSetting($this->pageType);

        $checkedCategory = isset($dataSetting['options']['mainCategory']) ?
            explode(',', $dataSetting['options']['mainCategory']) : $request->old('mainCategory');

        $templateCategory = $this->postServices->getCheckboxCategory(
            Category::CATALOG_TYPE,
            $checkedCategory,
            'mainCategory'
        );

        $checkedSubCategory = isset($dataSetting['options']['selectedCatalog']) ?
            explode(',', $dataSetting['options']['selectedCatalog']) : $request->old('selectedCatalog');

        $templateSubCategory = $this->postServices->getCheckboxCategory(
            Category::CATALOG_TYPE,
            $checkedSubCategory,
            'selectedCatalog'
        );

        return view('backend.theme.setting', [
            'option' => $dataSetting['options'],
            'pages' => $dataSetting['pages'],
            'menus' => $dataSetting['menus'],
            'templateCategory' => $templateCategory,
            'templateSubCategory' => $templateSubCategory
        ]);
    }

    /**
     * Save setting site.
     * @param SettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(SettingRequest $request)
    {
        $this->optionServices->saveSetting($request);

        return redirect()->route('setting.index')->with(['success' => 'Update successful']);
    }
}

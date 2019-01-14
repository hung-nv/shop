<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Option;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Define type.
     * @var
     */
    protected $articleType = Article::POST_TYPE;
    protected $categoryType = Category::CATEGORY_TYPE;
    protected $pageType = Article::PAGE_TYPE;

    protected $idsExcept = [];

    /**
     * Define option setting.
     * @var
     */
    protected $option;

    protected $mainMenu;

    public function __construct()
    {
        $this->setIdsExcept([]);

        $this->setType();

        $this->getSettingSite();

        $this->getMenu();

        $this->getGeneralArticle();

        $this->getAdvertising();
    }

    public function getAdvertising()
    {
        $advertising = Advertising::all()->pluck('content', 'id');

        View::share('advertising', $advertising);
    }

    /**
     * Set id except.
     * @param $idExcept
     */
    public function setIdsExcept($idExcept)
    {
        if ($idExcept) {
            if (is_array($idExcept)) {
                $this->idsExcept = array_merge($this->idsExcept, $idExcept);
            } else {
                array_push($this->idsExcept, $idExcept);
            }
        }
    }

    public function setType()
    {
        View::share('pageType', $this->pageType);
    }

    /**
     * Get general article.
     */
    public function getGeneralArticle()
    {
        View::composer([
            'partials._sidebar',
            'mobile.news._hotArticles',
            'mobile.news.view'
        ], function ($view) {
            $topInWeek = Article::getTopArticlesInWeek(5, $this->idsExcept);

            $newArticles = Article::getNewArticle(5, $this->idsExcept);

            $view->with('topInWeek', $topInWeek);

            $view->with('newArticles', $newArticles);
        });
    }

    /**
     * Setting site.
     */
    public function getSettingSite()
    {
        $this->option = Option::all()->pluck('value', 'key');

        View::share('option', $this->option);
    }

    /**
     * Get menu.
     */
    public function getMenu()
    {
        if (!empty($this->option['main_menu_id'])) {
            $mainMenu = $this->setMultiMenu(Menu::getMenuByGroup($this->option['main_menu_id'])->toArray());

            View::share('mainMenu', $mainMenu);
        }

        if (!empty($this->option['footer_menu_id'])) {
            $footerMenu = $this->setMultiMenu(Menu::getMenuByGroup($this->option['footer_menu_id'])->toArray());

            View::share('footerMenu', $footerMenu);
        }
    }

    /**
     * Set multi level menu.
     * @param $data
     * @return array
     */
    private function setMultiMenu($data)
    {
        $return = [];
        foreach ($data as $item) {
            // set url.
            $item['url'] = $this->setUrlForMenu($item);

            $child = [];

            foreach ($data as $n => $i) {
                $grand = [];

                if ($i['parent_id'] == $item['id']) {
                    // set url.
                    $i['url'] = $this->setUrlForMenu($i);
                    // unset from all data.
                    unset($data[$n]);

                    foreach ($data as $m => $j) {
                        if ($j['parent_id'] == $i['id']) {
                            // set url.
                            $j['url'] = $this->setUrlForMenu($j);

                            $grand[] = $j;
                            // unset from all data.
                            unset($data[$m]);
                        }
                    }

                    if (isset($grand) && $grand) {
                        $i['grand'] = $grand;
                    }

                    $child[] = $i;
                }
            }

            if (empty($child) && $item['parent_id'] == null) {
                $return[] = $item;
            } else if (!empty($child)) {
                $item['child'] = $child;
                $return[] = $item;
            }

        }
        return $return;
    }

    /**
     * Set url for menu.
     * @param array $option
     * @return string
     */
    private function setUrlForMenu($option)
    {
        if ($option['direct']) {
            $url = $option['direct'];
        } else {
            if ($option['type']) {
                $prefix = '/' . config('const.prefix.' . $option['type']);
            }

            $url = $prefix . '/' . $option['slug'];
        }

        return $url;
    }
}

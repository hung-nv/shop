<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LandingStore;
use App\Http\Requests\LandingUpdate;
use App\Http\Requests\PageStore;
use App\Http\Requests\PageUpdate;
use App\Http\Requests\PostStore;
use App\Http\Requests\PostUpdate;
use App\Services\ArticleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    private $postServices;

    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();

        $this->postServices = $articleServices;
    }

    /**
     * Show all pages.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pages = $this->postServices->getIndexPages([$this->pageType]);

        return view('backend.page.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Create page.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        $templateCategory = $this->postServices->getCheckboxCategory(
            $this->categoryType,
            $request->old('parent')
        );

        $name = $request->old('name') ? $request->old('name') : '';
        $slug = $request->old('slug') ? $request->old('slug') : '';

        return view('backend.page.create', [
            'templateCategory' => $templateCategory,
            'name' => $name,
            'slug' => $slug
        ]);
    }

    /**
     * Store page.
     * @param PostStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PageStore $request)
    {
        $response = $this->postServices->createPost($request, $this->pageType);

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Edit page.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function edit(Request $request, $id)
    {
        try {
            $dataPost = $this->postServices->getPostInformationById($request, $id);

            $templateCategory = $this->postServices->getCheckboxCategory(
                $this->categoryType,
                $dataPost['post_category']
            );

            return view('backend.page.update', [
                'templateCategory' => $templateCategory,
                'page' => $dataPost['post'],
                'name' => $dataPost['name'],
                'slug' => $dataPost['slug']
            ]);
        } catch (\Exception $exception) {
            return abort(403);
        }
    }

    /**
     * Update page.
     * @param PageUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(PageUpdate $request, $id)
    {
        $response = $this->postServices->updatePost($request, $id, true);

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Delete page.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->postServices->deletePage($id, '');

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }
}

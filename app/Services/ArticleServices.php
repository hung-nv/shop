<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Group;
use App\Models\MetaField;
use App\Models\Article;
use App\Services\Common\ImageServices;
use App\Utilities\MultiLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleServices
{
    use MultiLevel;

    private $imageServices, $menuServices;

    public function __construct(ImageServices $imageServices, MenuServices $menuServices)
    {
        $this->imageServices = $imageServices;
        $this->menuServices = $menuServices;
    }

    /**
     * Get index posts.
     * @param $request
     * @param $postType
     * @return array
     */
    public function getIndexPosts($request, $postType)
    {
        $name = empty($request['name']) ? '-1' : $request['name'];

        $posts = Article::getPostsByName($name, 20, $postType);

        $groups = Group::getGroupByIds(config('const.groups.article'));

        return ['name' => $name, 'posts' => $posts, 'groups' => $groups];
    }

    /**
     * Get all pages.
     * @param array $type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getIndexPages(array $type)
    {
        return Article::getAllPages($type);
    }

    /**
     * Get template checkbox category.
     * @param $categoryType
     * @param $parent
     * @param string $name
     * @return string
     * @throws \Throwable
     */
    public function getCheckboxCategory($categoryType, $parent, $name = 'parent')
    {
        $category = Category::getCategoryByType($categoryType);

        $template = $this->getTemplateCheckboxCategory($category, $parent, $name);

        return $template;
    }

    /**
     * Create post.
     * @param Request $request
     * @param $postType
     * @return string
     * @throws \Exception
     */
    public function createPost($request, $postType)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('image'), 'posts');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['image'] = $fileName;
        }

        $data['user_id'] = \Auth::user()->id;
        $data['type'] = $postType;

        try {
            DB::beginTransaction();

            $response = $this->storePostPackage($data);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Store post package.
     * @param $data
     * @return string
     */
    public function storePostPackage($data)
    {
        $post = Article::create($data);

        if (!empty($data['parent'])) {
            $post->category()->attach($data['parent']);
        }

        $message = 'Create "' . $post->name . '" successful';

        return $message;
    }

    /**
     * Get post by id.
     * @param Request $request
     * @param $id
     * @return array
     */
    public function getPostInformationById($request, $id)
    {
        $post = Article::findOrFail($id);

        $post_category = [];
        foreach ($post->category as $i) {
            $post_category[] = $i->id;
        }

        $name = $post->name ? $post->name : $request->old('name');
        $slug = $post->slug ? $post->slug : $request->old('slug');

        $return = [
            'post' => $post,
            'post_category' => $post_category,
            'name' => $name,
            'slug' => $slug
        ];

        return $return;
    }

    /**
     * Get data landing page.
     * @param $request
     * @param $id
     * @return array
     */
    public function getLandingInformationById($request, $id)
    {
        $page = Article::findOrFail($id);

        $post_category = [];
        foreach ($page->category as $i) {
            $post_category[] = $i->id;
        }

        $name = $page->name ? $page->name : $request->old('name');
        $slug = $page->slug ? $page->slug : $request->old('slug');

        $dataLanding = MetaField::getDataLandingById($id);

        $return = [
            'page' => $page,
            'post_category' => $post_category,
            'name' => $name,
            'slug' => $slug,
            'dataLanding' => $dataLanding
        ];

        return $return;
    }

    /**
     * Update post.
     * @param $request
     * @param $id
     * @param bool $updateMenu
     * @return string
     * @throws \Exception
     */
    public function updatePost($request, $id, $updateMenu = false)
    {
        try {
            DB::beginTransaction();

            $response = $this->updatePostPackage($request, $id, $updateMenu);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Update post.
     * @param Request $request
     * @param int $id
     * @param bool $updateMenu
     * @return string
     * @throws \Exception
     */
    public function updatePostPackage($request, $id, $updateMenu)
    {
        $post = Article::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // delete old image if exist.
            if (isset($request->old_image) && $request->old_image) {
                $this->imageServices->deleteImage($request->old_image);
            }

            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('image'), 'posts');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['image'] = $fileName;
        }

        // update menu if page.
        if ($updateMenu) {
            $this->menuServices->updatePageToMenu($post->slug, $request->name, $request->slug);
        }

        if ($post->update($data)) {
            $post->category()->sync($request->parent);
        }

        $message = '"' . $post->name . '" has been updated!';

        return $message;
    }

    /**
     * Add post to group.
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function addPostToGroup($data)
    {
        $post = Article::findOrFail($data['post_id']);

        $post->groups()->attach([$data['group_id']]);

        if ($post->groups->contains($data['group_id'])) {
            $message = 'This post has been add to "' . $data['group_name'] . '"';

            return $message;
        } else {
            throw new \Exception('Fail to add post to group.');
        }
    }

    /**
     * Remove post from group.
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function removePostToGroup($data)
    {
        $post = Article::findOrFail($data['post_id']);

        $post->groups()->detach([$data['group_id']]);

        if ($post->groups->contains($data['group_id'])) {
            throw new \Exception('Fail to remove post to group.');
        } else {
            $message = 'This post has been remove from "' . $data['group_name'] . '"';

            return $message;
        }
    }

    /**
     * Create landing page.
     * @param $request
     * @param int $landingType
     * @return string
     * @throws \Exception
     */
    public function createLandingPage($request, int $landingType)
    {
        try {
            DB::beginTransaction();

            $response = $this->storeLandingPackage($request, $landingType);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Store landing page package.
     * @param Request $request
     * @param int $landingType
     * @return string
     * @throws \Exception
     */
    public function storeLandingPackage($request, int $landingType)
    {
        $data = $request->all();

        $dataPage = [
            'name' => $request->name,
            'slug' => $request->slug,
            'user_id' => \Auth::user()->id,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'type' => $landingType
        ];

        $landing = Article::create($dataPage);

        $landing->category()->attach($request->parent);

        unset(
            $data['_token'],
            $data['slug'],
            $data['parent'],
            $data['name'],
            $data['description'],
            $data['status'],
            $data['meta_title'],
            $data['meta_description']
        );

        foreach ($data as $key => $v) {
            if (!empty($key) && $v) {

                if (strlen(strstr($key, 'image')) > 0) {
                    // upload image.
                    $value = $this->imageServices->uploads($request->file($key), 'fields');
                } else {
                    $value = $v;
                }

                $landing->fields()->create([
                    'key_name' => $key,
                    'key_value' => $value
                ]);
            }
        }

        return 'Landing page "' . $request->name . '" create successful.';
    }

    /**
     * Update landing package.
     * @param Request $request
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function updateLanding($request, $id)
    {
        $data = $request->all();

        $dataPage = [
            'name' => $request->name,
            'slug' => str_slug($request->slug),
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ];

        $landing = Article::findOrFail($id);

        unset(
            $data['_token'],
            $data['slug'],
            $data['parent'],
            $data['name'],
            $data['status'],
            $data['meta_title'],
            $data['meta_description']
        );

        $landing->update($dataPage);

        $landing->category()->sync($request->parent);

        foreach ($data as $k => $v) {
            if ($v) {
                // except other value.
                if (strlen(strstr($k, 'old')) > 0 || strlen(strstr($k, '_method')) > 0) {
                    continue;
                }

                $field = MetaField::getFieldByArticleIdAndName($id, $k);

                if (strlen(strstr($k, 'image')) > 0) {
                    if ($request->hasFile($k)) {
                        // delete old image.
                        if (!empty($field)) {
                            $this->imageServices->deleteImage($field->key_value);
                        }

                        $value = $this->imageServices->uploads($request->file($k), 'fields');
                    }

                } else {
                    $value = $v;
                }

                if ($field) {
                    $field->update(['key_value' => $value]);
                } else {
                    $landing->fields()->create([
                        'key_name' => $k,
                        'key_value' => $value
                    ]);
                }
            }
        }

        return 'Landing page "' . $request->name . '" update successful.';
    }

    /**
     * Delete post image by id.
     * @param $postId
     * @return array
     */
    public function deleteImageByPostId($postId)
    {
        $post = Article::findOrFail($postId);

        if (!$post) {
            throw new NotFoundHttpException('Not found post');
        } else {
            $deleteFile = $this->imageServices->deleteImage($post->image);

            if (empty($deleteFile)) {
                throw new NotFoundHttpException('Not found image');
            }

            $post->update(['image' => null]);

            return ['message' => 'Delete file successful'];
        }
    }

    /**
     * Delete image of landing page.
     * @param $pageId
     * @param $optionName
     * @return array
     * @throws \Exception
     */
    public function deleteImageLandingByPageId($pageId, $optionName)
    {
        $field = MetaField::getFieldByArticleIdAndName($pageId, $optionName);

        if (!$field) {
            throw new NotFoundHttpException('Not found page');
        } else {
            $deleteFile = $this->imageServices->deleteImage($field->key_value);

            if (empty($deleteFile)) {
                throw new NotFoundHttpException('Not found image');
            }

            $field->delete();

            return ['message' => 'Delete file successful'];
        }
    }

    /**
     * Delete page.
     * @param $pageId
     * @param $landingType
     * @return string
     * @throws \Exception
     */
    public function deletePage($pageId, $landingType)
    {
        try {
            DB::beginTransaction();

            $this->deletePagePackage($pageId, $landingType);

            DB::commit();

            return 'Your page has been deleted.';
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Delete post.
     * @param $postId
     * @return string
     * @throws \Exception
     */
    public function deletePost($postId)
    {
        try {
            DB::beginTransaction();

            $this->deletePostPackage($postId);

            DB::commit();

            return 'Your post has been deleted.';
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Delete post package.
     * @param $postId
     * @throws \Exception
     */
    public function deletePostPackage($postId)
    {
        $post = Article::findOrFail($postId);
        $post->category()->detach();

        if ($post->delete()) {
            $this->imageServices->deleteImage($post->image);
        }
    }

    /**
     * Delete page package.
     * @param int $pageId
     * @param int $landingType
     * @throws \Exception
     */
    public function deletePagePackage($pageId, $landingType)
    {
        $page = Article::findOrFail($pageId);

        $page->category()->detach();

        if ($page->type === $landingType) {
            // delete image of landing page.
            MetaField::where('article_id', $pageId)->get()->each(function ($field) {
                if (strlen(strstr($field->key_name, 'image')) > 0) {
                    $this->imageServices->deleteImage($field->key_value);
                }
            });
        }

        if ($page->delete()) {
            $this->imageServices->deleteImage($page->image);
        }
    }

    /**
     * @param $idsCategory
     * @param $idExcept
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedArticle($idsCategory, $idExcept)
    {
        return Article::getArticlesByIdsCategory($idsCategory, 10, [$idExcept]);
    }

    /**
     * Get articles by groupId
     * @param $groupId
     * @param $limit
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getArticlesByGroupId($groupId, $limit)
    {
        return Article::getArticlesByGroupId($groupId, $limit);
    }

    /**
     * Get top articles in week
     * @param $limit
     * @return mixed
     */
    public function getTopArticlesInWeek($limit)
    {
        return Article::getTopArticlesInWeek($limit);
    }

    /**
     * Get new articles.
     * @param $limit
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getNewArticles($limit)
    {
        return Article::getNewArticle($limit);
    }

    /**
     * Get article by slug.
     * @param $slug
     * @return Article|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function getArticleBySlug($slug)
    {
        return Article::getArticleBySlug($slug);
    }

    /**
     * Update view article by id.
     * @param $articleId
     * @return bool
     */
    public function updateViewArticle($articleId)
    {
        return Article::find($articleId)->update(['view' => DB::raw('view + 1')]);
    }

    /**
     * get all posts in category
     *
     * @param  int $categoryId
     * @param  string $articleType
     * @return object $posts
     */

    public function getAllPostsByParentCategory($categoryId, $articleType)
    {
        $idsCategory = [];

        $allCategory = Category::all();

        $this->getIdsCategoryByParent($allCategory, $idsCategory, $categoryId);

        $articles = Article::paginateArticlesByIdsCategory($idsCategory, $articleType, 10);

        return $articles;
    }

    /**
     * Get all articles by name.
     * @param $name
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllArticlesByName($name)
    {
        $articles = Article::paginateArticlesByName($name, 10);

        return $articles;
    }

    /**
     * Get catalog with products.
     * @param $idsCategory
     * @param int $limit
     * @param array $idsExcept
     * @return array|null
     */
    public function getWidgetCategoryWithArticles($idsCategory, $limit, $idsExcept)
    {
        $return = [];

        $dataCategory = Category::all();

        $idsCategory = explode(',', $idsCategory);

        if (count($idsCategory) > 0) {

            foreach ($idsCategory as $idCategory) {
                $idsResult = [];

                // get all children id catalog.
                $this->getIdsCategoryByParent($dataCategory, $idsResult, $idCategory);

                array_push($idsResult, $idCategory);

                $articles = Article::getArticlesByIdsCategory($idsResult, $limit, $idsExcept);

                $category = $dataCategory->where('id', $idCategory)->first();

                if (count($articles) > 0) {
                    $return[] = ['category' => $category, 'articles' => $articles];
                }
            }

            return $return;
        }

        return null;
    }
}
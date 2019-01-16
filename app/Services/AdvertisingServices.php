<?php

namespace App\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Advertising;
use App\Services\Common\ImageServices;
use Illuminate\Foundation\Http\FormRequest;

class AdvertisingServices
{
    private $imageServices;

    public function __construct(ImageServices $imageServices)
    {
        $this->imageServices = $imageServices;
    }

    public function getAllAdvertising()
    {
        return Advertising::all();
    }

    /**
     * Create advertising.
     * @param FormRequest $request
     * @return string
     * @throws \Exception
     */
    public function createAdvertising($request)
    {
        $data = $request->all();

        if ($request->type == 1) {
            $data['content'] = $request->script;

            $data['group'] = null;
        } elseif ($request->type == 2) {
            if ($request->hasFile('image')) {
                // upload image to folder.
                $fileName = $this->imageServices->uploads($request->file('image'), 'advertising');

                if (empty($fileName)) {
                    return 'Fail';
                }

                $data['content'] = $fileName;
            }
        }

        Advertising::create($data);

        $message = 'Create successful';

        return $message;
    }

    /**
     * Get advertising by id.
     * @param $id
     * @return Advertising|Advertising[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getAdvertisingById($id)
    {
        return Advertising::find($id);
    }

    /**
     * Update advertising.
     * @param FormRequest $request
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function updateAdvertising($request, $id)
    {
        $advertising = Advertising::find($id);

        $data = $request->all();

        if ($request->type == 1) {
            $data['content'] = $request->script;

            if ($advertising->type == 2) {
                // delete old image.
                $this->imageServices->deleteImage($advertising->content);
            }
        } elseif ($request->type == 2) {
            if ($request->hasFile('image')) {
                if ($advertising->type == 2) {
                    // delete old image.
                    $this->imageServices->deleteImage($advertising->content);
                }
                // upload image to folder.
                $fileName = $this->imageServices->uploads($request->file('image'), 'advertising');

                if (empty($fileName)) {
                    return 'Fail';
                }

                $data['content'] = $fileName;
            }
        }

        $advertising->update($data);

        return 'Update successful';
    }

    /**
     * Delete advertising.
     * @param $id
     * @throws \Exception
     */
    public function deleteAdvertisingById($id)
    {
        $advertising = Advertising::find($id);

        if ($advertising->type == 2) {
            // delete old image.
            $this->imageServices->deleteImage($advertising->content);
        }

        $advertising->delete();
    }

    /**
     * Delete image by id.
     * @param $id
     * @return array
     */
    public function deleteImageById($id)
    {
        $advertising = Advertising::findOrFail($id);

        if (!$advertising) {
            throw new NotFoundHttpException('Not found advertising.');
        } else {
            $deleteFile = $this->imageServices->deleteImage($advertising->content);

            if (empty($deleteFile)) {
                throw new NotFoundHttpException('Not found image.');
            }

            $advertising->update(['content' => null]);

            return ['message' => 'Delete file successful.'];
        }
    }
}
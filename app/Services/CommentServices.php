<?php

namespace App\Services;

use App\Models\Comment;
use App\Services\Common\ImageServices;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentServices
{
    public function getAllComment()
    {
        return Comment::all();
    }

    /**
     * Store comment
     * @param FormRequest $request
     * @return string
     * @throws \Exception
     */
    public function storeComment($request)
    {
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            // upload image to folder.
            $fileName = ImageServices::on()->uploads($request->file('avatar'), 'comment');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['avatar'] = $fileName;
        }

        Comment::create($data);

        $message = 'Create comment successful';

        return $message;
    }

    /**
     * Find comment by id.
     * @param $idComment
     * @return Comment|Comment[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findCommentById($idComment)
    {
        return Comment::find($idComment);
    }

    /**
     * Delete comment avatar.
     * @param $idComment
     * @return array
     */
    public function deleteImageByCommentId($idComment)
    {
        $comment = Comment::find($idComment);

        if (!$comment) {
            throw new NotFoundHttpException('Not found comment.');
        } else {
            $deleteFile = ImageServices::on()->deleteImage($comment->avatar);

            if (empty($deleteFile)) {
                throw new NotFoundHttpException('Not found image.');
            }

            $comment->update(['avatar' => null]);

            return ['message' => 'Delete file successful.'];
        }
    }

    /**
     * Update comment.
     * @param FormRequest $request
     * @param $idComment
     * @return string
     * @throws \Exception
     */
    public function updateComment($request, $idComment)
    {
        $comment = Comment::findOrFail($idComment);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            // delete old image comment.
            ImageServices::on()->deleteImage($comment->image);

            // upload image to folder.
            $fileName = ImageServices::on()->uploads($request->file('avatar'), 'comment');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['avatar'] = $fileName;
        }

        $comment->update($data);

        $message = 'Update successful';

        return $message;
    }

    /**
     * Delete comment.
     * @param $idComment
     * @return string
     * @throws \Exception
     */
    public function deleteComment($idComment)
    {
        $comment = Comment::findOrFail($idComment);

        ImageServices::on()->deleteImage($comment->avatar);

        $comment->delete();

        return 'Delete successful';
    }
}
<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CommentStore;
use App\Http\Requests\CommentUpdate;
use App\Services\CommentServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    private $commentServices;

    public function __construct(CommentServices $commentServices)
    {
        parent::__construct();

        $this->commentServices = $commentServices;
    }

    /**
     * Index comment.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $comments = $this->commentServices->getAllComment();

        return view('backend.comment.index', compact('comments'));
    }

    /**
     * Create comment.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.comment.create');
    }

    /**
     * Store comment.
     * @param CommentStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CommentStore $request)
    {
        $response = $this->commentServices->storeComment($request);

        return redirect()->route('comment.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Edit comment.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->commentServices->findCommentById($id);

        return view('backend.comment.update', compact('data'));
    }

    /**
     * Update comment.
     * @param CommentUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(CommentUpdate $request, $id)
    {
        $response = $this->commentServices->updateComment($request, $id);

        return redirect()->route('comment.index')->with([
            'success' => $response
        ]);
    }

    public function destroy($id)
    {
        $response = $this->commentServices->deleteComment($id);

        return redirect()->route('comment.index')->with([
            'success' => $response
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function store(CommentRequest $request): RedirectResponse
    {
        $data = $request->all();
        $picture = $request->file('picture');
        if (!is_null($picture)) {
            $path = $picture->store('pictures', 'public');
            $data['picture'] = $path;
        }
        $post = Post::find($request->get('post_id'));
        Comment::create($data);
        return redirect()->action([PostsController::class, 'show'], ['post' => $post])
            ->with('status', "Comment successfully created!");
    }

    /**
     * @param Comment $comment
     * @return View
     */
    public function edit(Comment $comment): View
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * @param CommentRequest $request
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function update(CommentRequest $request, Comment $comment): RedirectResponse
    {
        $data = $request->all();
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $path = $file->store('pictures', 'public');
            $data['picture'] = $path;
        }
        $comment->update($data);
        $post = Post::find($request->get('post_id'));
        return redirect()->action([PostsController::class, 'show'], ['post' => $post])
            ->with('status', "Comment successfully updated!");
    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function destroy(Request $request, Comment $comment): RedirectResponse
    {
        $comment->delete();
        $post = Post::find($request->get('post_id'));
        return redirect()->action([PostsController::class, 'show'], ['post' => $post])
            ->with('status', "Comment successfully deleted!");
    }
}

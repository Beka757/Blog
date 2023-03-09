<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return  view('posts.create');
    }

    /**
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->all();
        $picture = $request->file('picture');
        if (!is_null($picture)) {
            $path = $picture->store('pictures', 'public');
            $data['picture'] = $path;
        }
        $post = Post::create($data);
        return redirect()->route('home')->with('status', "{$post->name} successfully created!");
    }

    /**
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        $post->setRelation('comments', $post->comments()->simplePaginate(10));
        return view('posts.show', compact('post'));
    }

    /**
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'name' => 'required|min:10|max:100',
            'body' => 'required|min:10|max:3000',
            'picture' => 'image',
        ]);
        $data = $request->all();
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $path = $file->store('pictures', 'public');
            $data['picture'] = $path;
        }
        $post->update($data);
        return redirect()->action([self::class, 'show'], ['post' => $post])
            ->with('status', "Post {$post->name} successfully updated!");
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('status', "{$post->name} successfully deleted!");
    }
}

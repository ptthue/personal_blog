<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\SaveRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\Admin\PostService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService,
    ) {}

    public function index(): Factory|View
    {
        $posts = Post::with(['user', 'category'])->paginate(1);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): Factory|View
    {
        $categories = Category::all();

        return view('admin.posts.create', [
            'categories' => $categories,
        ]);
    }

    public function store(SaveRequest $request): RedirectResponse
    {
        $this->postService->store(
            user: $request->user(),
            data: $request->validated(),
            file: $request->file('image'),
        );

        return redirect()->route('admin.posts.index')
            ->with('success', __('Post created successfully.'));
    }

    public function edit(Post $post): Factory|View
    {
        $categories = Category::all();
        $tags = $post->tags()->pluck('name')->toArray();

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => implode(',', $tags),
        ]);
    }

    public function update(SaveRequest $request, Post $post): RedirectResponse
    {
        $this->postService->update($post, $request->validated(), $request->file('image'));

        return redirect()->route('admin.posts.index')
            ->with('success', __('Post updated successfully.'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->destroy($post);

        return redirect()->route('admin.posts.index')
            ->with('success', __('Post deleted successfully.'));
    }
}

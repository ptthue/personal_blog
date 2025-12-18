<?php

namespace App\Services\Admin;

use App\Models\Post;
use App\Models\User;
use App\Services\Common\ImageStorageLocal;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function __construct(
        private readonly ImageStorageLocal $imageStorage,
        private readonly TagService $tagService,
    ) {}

    public function store(User $user, array $data, ?UploadedFile $file): void
    {
        DB::transaction(function () use ($user, $data, $file) {
            $imagePath = $this->imageStorage->store($file, 'uploads/posts', 'public');

            $post = $user->posts()->create([
                'title' => $data['title'],
                'image_path' => $imagePath,
                'content' => $data['content'],
                'category_id' => $data['category_id'],
            ]);

            $this->tagService->syncPostTags($post, $data['tags'] ?? '');
        });
    }

    public function update(Post $post,array $data, ?UploadedFile $file): void
    {
        DB::transaction(function () use ($post, $data, $file) {
            if ($file) {
                $this->imageStorage->delete($post->image_path, 'uploads/posts', 'public');

                $filename = $this->imageStorage->store($file, 'uploads/posts', 'public');
            }

            $post->update([
                'title' => $data['title'],
                'image_path' => $filename ?? $post->image_path,
                'content' => $data['content'],
                'category_id' => $data['category_id'],
            ]);

            $this->tagService->syncPostTags($post, $data['tags'] ?? '');
        });
    }
}

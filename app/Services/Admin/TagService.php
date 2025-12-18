<?php

namespace App\Services\Admin;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Validation\ValidationException;

class TagService
{
    /**
     * @throws ValidationException
     */
    public function syncPostTags(Post $post, string $tags): void
    {
        $tags = collect(explode(',', $tags))
            ->map(fn($tag) => trim($tag))
            ->filter()
            ->unique()
            ->values();

        if ($tags->isEmpty()) {
            throw ValidationException::withMessages([
                'tags' => 'At least one tag is required.',
            ]);
        }

        $tagIds = $tags->map(function ($tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            return $tag->id;
        });

        $post->tags()->sync($tagIds->all());
    }
}

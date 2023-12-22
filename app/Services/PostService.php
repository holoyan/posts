<?php


namespace App\Services;


use App\Models\Post;

class PostService
{
    /**
     * @param array $data
     * @return Post
     */
    public function store(array $data): Post
    {
        return Post::create($data);
    }
}

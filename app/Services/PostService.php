<?php


namespace App\Services;


use App\Models\Post;

class PostService
{
    public function __construct(private Post $model)
    {}

    /**
     * @param array $data
     * @return Post
     */
    public function store(array $data): Post
    {
        return $this->model->create($data);
    }

    /**
     * @param array $constraint
     * @param int $userId
     * @return mixed
     */
    public function search(array $constraint, int $userId)
    {
        $conditions = $this->model->where('user_id', $userId);
        $perPage = $constraint['perPage'];
        $page = $constraint['page'];

        if (isset($constraint['is_published'])) {
            $conditions = $conditions->where('is_published', (bool)$constraint['is_published']);
        }

        return Post::search($constraint['term'])->constrain($conditions)->paginate(perPage: $perPage, page:$page);
    }
}

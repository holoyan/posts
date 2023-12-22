<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // modify fields which need to be returned
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'userId' => $this->userId,
            'isPublished' => $this->is_published,
            'updateAt' => $this->updated_at->toDateTimeString(),
        ];
    }
}

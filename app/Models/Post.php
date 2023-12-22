<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public const TITLE_MAX_LENGTH = 128;

    public const BODY_MAX_LENGTH = 4096;


    /**
     * @return string
     */
    public function searchableAs(): string
    {
        return 'posts_index';
    }


    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
        ];
    }
}

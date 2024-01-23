<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'banner_image',
        'content_image',
        'presentation',
        'isPublic',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'category_id' => 'integer',
        'tag_id' => 'integer',
    ];

    public function idUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function idCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function idTag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}

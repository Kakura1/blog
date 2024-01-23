<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
        'image',
        'isPublic',
    ];

    protected $casts = [
        'id' => 'integer',
        'id_user' => 'integer',
    ];

    public function idUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'description',
        'isPublic',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'isPublic' => 'boolean',
    ];

    public function idUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Previsao extends Model
{
    protected $table = 'previsoes';

    protected $fillable = [
        'user_id', 'category_id', 'top_value', 'value_now'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

}

<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\Models;

use Illuminate\Database\Eloquent\Model;

class Tinyurl extends Model
{
    protected $table = 'tinyurls';

    protected $fillable = [
        'url',
        'slug',
        'redirect',
    ];
}

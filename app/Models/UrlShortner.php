<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShortner extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_tag',
        'url_prefix',
        'url',
        'short_url'
    ];

}

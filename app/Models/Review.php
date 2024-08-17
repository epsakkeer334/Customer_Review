<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'review_text',
        'rating',
        'sentiment',
    ];
}

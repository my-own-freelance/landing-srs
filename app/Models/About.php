<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['description', 'location', 'address', 'whatsapp', 'telegram', 'email', 'twitter', 'youtube', 'linkedin'];
}

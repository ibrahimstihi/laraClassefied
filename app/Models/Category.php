<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','url_icon'
    ];

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}

<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'price',
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}

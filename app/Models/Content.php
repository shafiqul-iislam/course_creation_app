<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'title',
        'module_id',
        'type',
        
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}

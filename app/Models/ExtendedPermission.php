<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as BasePermission;

class ExtendedPermission extends BasePermission
{
    use HasFactory;


    public function scopeSearch($query, $value)
    {
        $query->where("name", "like", "%{$value}%");
    }
}

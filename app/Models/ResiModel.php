<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResiModel extends Model
{
    use HasFactory;

    protected $table = 'resi';
    protected $guarded = [];

    public function scopeSearch($query, $value){
        $query->where("no_resi", "like", "%{$value}%");
    }


    public function containers()
    {
        return $this->hasMany(Container::class, 'resi_id');
    }
}

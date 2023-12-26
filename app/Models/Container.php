<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $table = 'containers';
    protected $guarded = [];


    public function items()
    {
        return $this->hasMany(Item::class, 'container_id');
    }

    public function resi()
    {
        return $this->belongsTo(ResiModel::class, 'resi_id');
    }

    public function asal(){
        return $this->belongsTo(Customer::class, 'asal_barang');

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['cliente_id','total'];

    public function productos(){
        return $this->belongsToMany('App\Models\Producto')->withPivot('subtotal','cantidad');
    }
}

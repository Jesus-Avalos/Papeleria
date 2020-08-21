<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre','descripcion','precio_venta','precio_compra','stock','categoria_id'];

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }

    public function ventas(){
        return $this->belongsToMany('App\Models\Venta')->withPivot('subtotal','cantidad');
    }
}

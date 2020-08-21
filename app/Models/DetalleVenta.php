<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DetalleVenta extends Pivot
{
    protected $fillable = ['venta_id','producto_id','subtotal','cantidad'];
}

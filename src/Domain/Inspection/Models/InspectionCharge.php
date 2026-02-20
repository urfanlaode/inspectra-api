<?php

namespace Domain\Inspection\Models;

use Domain\Reference\Models\Uom;
use Illuminate\Database\Eloquent\Model;

class InspectionCharge extends Model
{
    protected $casts = [
        'qty' => 'integer',
        'price' => 'float',
        'amount' => 'float',
    ];

    protected $fillable = [
        'inspection_id',
        'order_no',
        'uom_id',
        'qty',
        'price',
        'amount',
    ];

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class);
    }
}

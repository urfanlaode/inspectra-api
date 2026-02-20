<?php

namespace Domain\Inspection\Models;

use Domain\Reference\Models\Lot;
use Illuminate\Database\Eloquent\Model;

class InspectionItemLot extends Model
{
    protected $casts = [
        'qty_required' => 'integer',
        'available_qty_snapshot' => 'integer',
    ];

    protected $fillable = [
        'inspection_item_id',
        'lot_id',
        'qty_required',
        'available_qty_snapshot',
    ];

    public function inspection_item()
    {
        return $this->belongsTo(InspectionItem::class);
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }
}

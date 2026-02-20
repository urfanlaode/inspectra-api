<?php

namespace Domain\Inspection\Models;

use Domain\Reference\Models\Item;
use Illuminate\Database\Eloquent\Model;

class InspectionItem extends Model
{
    protected $casts = [
        'qty_requested' => 'integer',
    ];

    protected $fillable = ['inspection_id', 'item_id', 'qty_requested'];

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function lots()
    {
        return $this->hasMany(InspectionItemLot::class);
    }
}

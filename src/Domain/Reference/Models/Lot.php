<?php

namespace Domain\Reference\Models;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    protected $fillable = [
        'id',
        'item_id',
        'lot_number',
        'allocation_id',
        'owner_id',
        'condition_id',
        'uom_id',
        'qty',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class);
    }
}

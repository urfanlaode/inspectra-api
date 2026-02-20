<?php

namespace Domain\Inspection\Models;

use Domain\Reference\Models\Customer;
use Domain\Reference\Models\Location;
use Domain\Reference\Models\ScopeOfWork;
use Domain\Reference\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Domain\Inspection\Enums\InspectionStatus;

class Inspection extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => InspectionStatus::class,
        'estimated_completion_date' => 'date',
    ];

    protected $fillable = [
        'inspection_no',
        'service_type_id',
        'scope_of_work_id',
        'location_id',
        'customer_id',
        'is_customer_charged',
        'dc_code',
        'estimated_completion_date',
        'status',
        'note',
    ];

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function scope_of_work()
    {
        return $this->belongsTo(ScopeOfWork::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(InspectionItem::class);
    }

    public function lots()
    {
        return $this->hasManyThrough(
            InspectionItemLot::class,
            InspectionItem::class,
        );
    }
}

<?php

namespace Domain\Reference\Models;

use Illuminate\Database\Eloquent\Model;

class ScopeOfWork extends Model
{
    protected $fillable = ['id', 'service_type_id', 'name', 'description'];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}

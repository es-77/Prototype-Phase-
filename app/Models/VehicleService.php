<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleService extends Model
{
    // model table name
    protected $table = 'vehicle_services';

    // seting primary key to ServiceId instead of standard id
    protected $primaryKey = 'ServiceId';

    // fields that can be filled
    protected $fillable = [
        'ServiceName',
        'VehicleModel',
        'ServiceType',
        'ServiceAmount',
        'Picture'
    ];
}

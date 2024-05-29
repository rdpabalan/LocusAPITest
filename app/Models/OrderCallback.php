<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCallback extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [ 
        'id',
        'date',
        'order_status',
        'order_sub_status',
        'trigger_time',
        'lat',
        'lng',
        'team_id',
        'homebase_id',
        'location_id',
        'rider_id',
        'rider_name',
        'vehicle_id',
        'current_eta',
        'timestamp',
    ];

    //protected $guarded = [];

    protected $casts = [
        'id' => 'string',
        'trigger_time' => 'datetime',
        'current_eta' => 'datetime', 
    ];

    // You may not need this if you're handling casting in the controller
    protected $hidden = [
        'lat', // These fields are included in the JSON through relationships
        'lng', // So, you might want to hide them to avoid redundancy
    ];
}

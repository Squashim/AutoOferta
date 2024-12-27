<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'car_model_id',
        'vin',
        'mileage',
        'prod_year',
        'car_type',
        'drive_type',
        'fuel_type',
        'car_condition',
        'transmission',
        'engine_capacity',
        'engine_power',
        'color'
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'car_detail_features');
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{

    public function carModels()
    {
        return $this->hasMany(CarModel::class, 'car_brand_id');
    }
}

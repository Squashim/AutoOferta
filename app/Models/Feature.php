<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'feature_name', 'category_id'];

    public function category()
    {
        return $this->belongsTo(FeatureCategory::class, 'category_id');
    }

    public function carDetails()
    {
        return $this->belongsToMany(CarDetail::class, 'car_detail_features');
    }
}

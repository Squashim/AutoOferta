<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureCategory extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'category_name'];

    public function features()
    {
        return $this->hasMany(Feature::class, 'category_id');
    }
}

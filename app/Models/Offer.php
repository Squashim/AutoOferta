<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'price', 'status', 'phone', 'city', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carDetails()
    {
        return $this->hasOne(CarDetail::class);
    }

    public function images()
    {
        return $this->hasMany(OfferImage::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'offer_features');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'offer_id', 'user_id')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homesearch extends Model
{
    protected $fillable = ['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'];

    public function scopeName($query, $string)
    {
        return $query->where('name', 'like', '%' . $string . '%');
    }

    public function scopePriceMin($query, $number)
    {
        return $query->where('price', '>=', $number);
    }
    public function scopePriceMax($query, $number)
    {
        return $query->where('price', '<=', $number);
    }

    public function scopeBedrooms($query, $number)
    {
        return $query->where('bedrooms', $number);
    }
    public function scopeBathrooms($query, $number)
    {
        return $query->where('bathrooms', $number);
    }
    public function scopeStoreys($query, $number)
    {
        return $query->where('storeys', $number);
    }
    public function scopeGarages($query, $number)
    {
        return $query->where('garages', $number);
    }
}

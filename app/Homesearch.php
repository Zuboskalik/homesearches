<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homesearch extends Model
{
    protected $fillable = ['name', 'price', 'bedrooms', 'storeys', 'garages'];
}

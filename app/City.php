<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public  function addresses(){
        return $this->hasMany(Address::class);
    }
    public  function province(){
        return $this->balongsto(Province::class);
    }
}

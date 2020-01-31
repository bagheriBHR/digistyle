<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $upload = '/storage/photos/';

    public function getPathAttribute($photo)
    {
        return $this->upload . $photo;
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'photo_product','photo_id','product_id');
    }
}

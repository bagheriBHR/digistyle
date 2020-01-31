<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_product','product_id','category_id');
    }
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class,'attributeValue_product','product_id','attributeValue_id');
    }
    public function photos()
    {
        return $this->belongsToMany(Photo::class,'photo_product','product_id','photo_id');
    }
    public function rating()
    {
        return $this->morphMany(Rating::class,'rateable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}

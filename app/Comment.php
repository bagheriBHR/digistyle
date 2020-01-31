<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function children()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive')->where('status','=',1);
    }
}

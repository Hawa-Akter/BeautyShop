<?php

namespace BeautyShop;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



class Categories extends Model
{
    public $table = "categories";

    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }

    public function NavigationSubCategory(){
        return $this->hasMany('BeautyShop\SubCategory','category_id','id')->where('status',1);

    }
}

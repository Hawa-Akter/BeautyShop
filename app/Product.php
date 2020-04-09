<?php

namespace BeautyShop;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'productName'
            ]
        ];
    }
    public function AvgRate($slug){
        return  DB::table('ratings')
            ->where('slug',$slug)
            ->avg('rate');

    }
    public function productImages($id){
        return  DB::table('product_images')
            ->select('*')
            ->where('product_id',$id)
            ->get();

    }

}

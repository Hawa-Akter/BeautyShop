<?php

namespace BeautyShop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MarketProductImage extends Model
{
    public function productImages($id){
        return  DB::table('market_product_images')
            ->select('*')
            ->where('market_product_id',$id)
            ->get();


    }
}

<?php

namespace BeautyShop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BeautitianRating extends Model
{
    public function AvgBeautitianRate($id){
        return  DB::table('beautitian_ratings')
            ->where('beautitian_id',$id)
            ->avg('rate');

    }
}

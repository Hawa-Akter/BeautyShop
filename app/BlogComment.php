<?php

namespace BeautyShop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlogComment extends Model
{
    public function CommnetByID($id){
        return DB::table('blog_comments')
            ->join('users','users.id','=','blog_comments.user_id')
            ->select('blog_comments.*','users.name')
            ->where('blog_id',$id)
            ->get();
    }
    public function count($id){
        return DB::table('blog_comments')
            ->select('*')
            ->where('blog_id',$id)
            ->count();
    }
    public function profilePicture($id){
        return DB::table('beautitian_profiles')
            ->select('photo')
            ->where('user_id',$id)
            ->first();
    }

}

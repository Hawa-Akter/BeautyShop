<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\Product;
use BeautyShop\Wishlist;
use Illuminate\Http\Request;
use Cart;
use Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addProductToWishlist($id){
        $allwishlist=DB::table('wishlists')
            ->where('product_id',$id)
            ->where('user_id',Auth::user()->id)
            ->count();
    if ($allwishlist>0){
          return redirect('/wishlist')->with('mess','you have already added this product on wishlist');
        }else{
        $wishlist= new Wishlist();
        $wishlist->product_id=$id;
        $wishlist->user_id=Auth::user()->id;
        $wishlist->save();


        $Items=Product::find($id);
        Cart::instance('wishlist')->add([
            'id' => $Items->id,
            'name' => $Items->productName,
            'qty' => 1,
            'price' => $Items->productPrice-$Items->productPrice*$Items->discount/100,
            'options' => [
                'productImage' => $Items->productImage,
                'discount' => $Items->discount,
                'orgPrice' => $Items->productPrice,
                'slug' => $Items->slug,
                'details' => $Items->productDetails,
            ]
        ]);
    return redirect('/wishlist');
}

    }
    public function viewWishlist(){
        $allwishlist=Wishlist::where('user_id',Auth::user()->id)->get();

        foreach ($allwishlist as $item){
            $Items=Product::find($item->product_id);
            Cart::instance('wishlist')->add([
                'id' => $Items->id,
                'name' => $Items->productName,
                'qty' => $Items->quantity,
                'price' => $Items->productPrice-$Items->productPrice*$Items->discount/100,
                'options' => [
                    'productImage' => $Items->productImage,
                    'discount' => $Items->discount,
                    'orgPrice' => $Items->productPrice,
                    'slug' => $Items->slug,
                    'details' => $Items->productDetails,
                ]
            ]);
        }
        $allitems=Cart::instance('wishlist')->content();
        return view('frontEnd.wishlist.wishlist-content',['allitems'=>$allitems]);
    }
    public function delItemfromWishlist($id,$rowId){
       // dd($id);
        DB::table('wishlists')
            ->where('product_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->delete();
        Cart::instance('wishlist')->remove($rowId);
        return redirect('/wishlist')->with('mess','product removed successfully');
    }


    //compare functions

    public function showCompare(){
        $compareProducts=Cart::instance('compare')->content();

        return view('frontEnd.compare.showCompare',['compareProducts'=>$compareProducts]);
    }

    public function addToCompare($slug){
        $brandItems= DB::table('products')
            ->join('categories','categories.id','=','products.catId')
            ->join('sub_categories','sub_categories.id','=','categories.id')
            ->join('brands','brands.id','=','products.brandId')
            ->select('products.*','brands.brand_name','categories.category_name','sub_categories.title')
            ->where('products.slug','=',$slug)
            ->first();
        $avgStar=DB::table('ratings')
            ->select('rate')
            ->where('slug','=',$slug)
            ->avg('rate');

        Cart::instance('compare')->add([
            'id' => $brandItems->id,
            'name' => $brandItems->productName,
            'price' => $brandItems->productPrice,
            'qty' =>1,
            'options' => [
                'Code' => $brandItems->productSerial,
                'Image' => $brandItems->productImage,
                'Items' =>  $brandItems->quantity,
                'Description' =>$brandItems->productDetails,
                'Brand' =>$brandItems->brand_name,
                'discount' =>$brandItems->discount,
                'discountPrice' =>$brandItems->productPrice-$brandItems->productPrice*$brandItems->discount/100,
                'Category' =>$brandItems->category_name,
                'subCategory' =>$brandItems->title,
                'star' =>$avgStar,
                'slug' =>$brandItems->slug,
            ]
        ]);
        return redirect('/show-compare-product');
    }
    public function addMyCompare(Request $request){
        $slug=$request->slug;
        $brandItems= DB::table('products')
            ->join('categories','categories.id','=','products.catId')
            ->join('sub_categories','sub_categories.id','=','categories.id')
            ->join('brands','brands.id','=','products.brandId')
            ->select('products.*','brands.brand_name','categories.category_name','sub_categories.title')
            ->where('products.slug','=',$slug)
            ->first();
        $avgStar=DB::table('ratings')
            ->select('rate')
            ->where('slug','=',$slug)
            ->avg('rate');

        Cart::instance('compare')->add([
            'id' => $brandItems->id,
            'name' => $brandItems->productName,
            'price' => $brandItems->productPrice,
            'qty' =>1,
            'options' => [
                'Code' => $brandItems->productSerial,
                'Image' => $brandItems->productImage,
                'Items' =>  $brandItems->quantity,
                'Description' =>$brandItems->productDetails,
                'Brand' =>$brandItems->brand_name,
                'discount' =>$brandItems->discount,
                'discountPrice' =>$brandItems->productPrice-$brandItems->productPrice*$brandItems->discount/100,
                'Category' =>$brandItems->category_name,
                'subCategory' =>$brandItems->title,
                'star' =>$avgStar,
                'slug' =>$brandItems->slug,
            ]
        ]);
        return redirect('/show-compare-product');
    }
    public function removeCompare($id){


        Cart::instance('compare')->remove($id);

        return redirect('/show-compare-product');
    }
}

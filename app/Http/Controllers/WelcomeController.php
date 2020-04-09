<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\Brand;
use BeautyShop\Categories;
use BeautyShop\Product;
use BeautyShop\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{

        public function viewIndex()
        {
            $blogs=DB::table('blogs')
                ->select('*')
                ->where('status','=','1')
                ->orderBy('id','desc')
                ->take(3)
                ->get();
            $newProducts=DB::table('products')
                ->select('*')
                ->where('status','=','1')
                ->orderBy('id','desc')
                ->take(8)
                ->get();
            $newCategories=DB::table('categories')
                ->select('*')
                ->where('status','=','1')
                ->orderBy('id','desc')
                ->take(2)
                ->get();
            $newCategories2=DB::table('categories')
                ->select('*')
                ->where('status','=','1')
                ->orderBy('id','desc')
                ->skip(2)
                ->take(2)
                ->get();
            $avgRatings=New Product();
            $marketProducts=DB::table('market_products')
                ->select('*')
                ->where('status','=','1')
                ->where('quantity','>','0')
                ->orderBy('id','desc')
                ->get();

            return view('frontEnd.home.home-page',[
                'blogs'=>$blogs,
                'newProducts'=>$newProducts,
                'newCategories'=>$newCategories,
                'newCategories2'=>$newCategories2,
                'avgRatings'=>$avgRatings,
                'marketProducts'=>$marketProducts,


            ]);
        }


        public function viewAllProduct(){
        $allProducts=Product::where('status',1)->get();
        $allBrands=Brand::where('status',1)->get();
        $categories=Categories::where('status',1)->with('NavigationSubCategory')->get();
        $avgRatings=New Product();
        return view('frontEnd.product.allProduct',['allProducts'=>$allProducts,
            'avgRatings'=>$avgRatings,
            'categories'=>$categories,
            'allBrands'=>$allBrands,

        ]);
    }
    public function SubCategoryProducts($slug,$slug2){
        $category=Categories::where('slug',$slug)->first();
        $SubCategory=SubCategory::where('slug',$slug2)->first();
        $allBrands=Brand::where('status',1)->get();
        $categories=Categories::where('status',1)->with('NavigationSubCategory')->get();
        $allProducts=DB::table('products')
            ->select('*')
            ->where('CatId','=',$category->id)
            ->where('subCatId','=',$SubCategory->id)
            ->get();

        $avgRatings=New Product();
        return view('frontEnd.home.category-product',['allProducts'=>$allProducts,'categories'=>$categories,
            'allBrands'=>$allBrands,'avgRatings'=>$avgRatings]);

    }
    public function BrandProducts($slug){

        $brand=Brand::where('slug',$slug)->first();
        $allBrands=Brand::where('status',1)->get();
        $categories=Categories::where('status',1)->with('NavigationSubCategory')->get();
        $allProducts=DB::table('products')
            ->select('*')
            ->where('brandId','=',$brand->id)
            ->get();

        $avgRatings=New Product();
        return view('frontEnd.home.category-product',['allProducts'=>$allProducts,'categories'=>$categories,
            'allBrands'=>$allBrands,'avgRatings'=>$avgRatings]);

    }
    public function searchProduct(Request $request)
    {
        $avgRatings=New Product();
        $allBrands=Brand::where('status',1)->get();
        $categories=Categories::where('status',1)->with('NavigationSubCategory')->get();


            $searchFilter = $request->get('range');
            //dd($searchFilter);
            $filter =  explode(';',$searchFilter);
            $min = (int)$filter[0];
            $max = (int)$filter[1];

            $searchProducts = Product::where('status', '=', 1)
                ->whereBetween('productPrice', [$min, $max])
                ->get();
        //dd($searchProducts);
        return view('frontEnd.home.product_search', compact('searchProducts', 'value','min', 'max','allBrands','categories','avgRatings'));

    }

}

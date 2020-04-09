<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Gate;

class BrandController extends Controller
{

    public function viewBrand() {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $allBrands = Brand::all();
        return view('backend.Brand.manage-brand',['allBrands'=>$allBrands]);

    }
    public function newBrand(Request $request) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'brand_dialogue' => 'required',
            'brand_image' => 'required',
        ]);

        $brandImage=$request->file('brand_image');
        $directory='brand-images/';
        $imageName=$brandImage->getClientOriginalName();
        $imageUrl=$directory.$imageName;
        Image::make($brandImage)->save($imageUrl);



        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_dialogue = $request->brand_dialogue;
        $brand->brand_image = $imageUrl;
        $brand->status = 1;
        $brand->save();


        return redirect('/manage-brand')->with('message', 'Brand info save successfully');
    }
    public function unPublishBrandInfo($slug) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $BrandById = Brand::where('slug',$slug)->first();
        $BrandById->status = 0;
        $BrandById->save();
        return redirect('/manage-brand')->with('msg', 'Brand Disabled successfully');
    }
    public function publishBrandInfo($slug) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $BrandById = Brand::where('slug',$slug)->first();
        $BrandById->status = 1;
        $BrandById->save();
        return redirect('/manage-brand')->with('message', 'Brand Actived successfully');
    }
    public function editBrandInfo($slug) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        //$categoryById = Category::where('id', $id)->first();

        $brandById =DB::table('brands')
            ->select('*')
            ->where('slug','=',$slug)
            ->first();
        return view('backend.Brand.edit-brand', ['brandById'=>$brandById]);
    }
    public function updateBrandInfo(Request $request) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
//        $category = new Category();
        $this->validate($request, [
            'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'brand_dialogue' => 'required',
        ]);
        $brandImage=$request->file('brand_image');

        if($brandImage){

            $brandById = Brand::find($request->brand_id);
            unlink($brandById->brand_image);

            $directory='brand-images/';
            $imageName=$brandImage->getClientOriginalName();
            $imageUrl=$directory.$imageName;
            Image::make($brandImage)->save($imageUrl);

            $brandById = Brand::find($request->brand_id);
            $brandById->brand_name = $request->brand_name;
            $brandById->brand_dialogue = $request->brand_dialogue;
            $brandById->brand_image = $imageUrl;
            $brandById->status = $request->status;
            $brandById->save();

        }else {


            $brandById = Brand::find($request->brand_id);
            $brandById->brand_name = $request->brand_name;
            $brandById->brand_dialogue = $request->brand_dialogue;
            $brandById->status = $request->status;
            $brandById->save();
        }

        return redirect('/manage-brand')->with('message', 'Brand info updated successfully');
    }

}

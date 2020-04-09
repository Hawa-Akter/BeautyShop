<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\Categories;
use BeautyShop\SubCategory;
use Illuminate\Http\Request;
use Image;
use DB;
use Gate;

class CategoryController extends Controller
{
    public function viewCategories(){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $allCategories = Categories::all();
        return view('backend.categories.category-page', ['allCategories'=>$allCategories]);
    }
    public function NewCategory(Request $request){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $CategoryImage=$request->file('category_image');


        if($CategoryImage) {


            $directory = 'brand-images/';
            $imageName = $CategoryImage->getClientOriginalName();
            $imageUrl = $directory . $imageName;
            Image::make($CategoryImage)->save($imageUrl);

            $category = new Categories();
            $category->category_name = $request->category_name;
            $category->category_image = $imageUrl;
            $category->category_description = $request->category_description;
            $category->status = 1;
            $category->save();

            return redirect('/productCategories')->with('message','Category info saved Successfully with image!');
        }else{
            $category = new Categories();
            $category->category_name = $request->category_name;
            $category->category_description = $request->category_description;
            $category->status = 1;
            $category->save();

            return redirect('/productCategories')->with('message','Category info saved Successfully!');
        }
    }
    public function editCategory($slug){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $categoryById=DB::table('categories')
            ->select('*')
            ->where('slug','=',$slug)
            ->first();
        return view('backend.categories.edit-category',['categoryById'=>$categoryById]);
    }
    public function updateCategoryInfo(Request $request) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $CategoryImage=$request->file('category_image');


        if($CategoryImage) {

            $categoryById = Categories::find($request->id);

            $directory = 'brand-images/';
            $imageName = $CategoryImage->getClientOriginalName();
            $imageUrl = $directory . $imageName;
            Image::make($CategoryImage)->save($imageUrl);


            $categoryById->category_name = $request->category_name;
            $categoryById->category_image = $imageUrl;
            $categoryById->category_description = $request->category_description;
            $categoryById->status = $request->status;
            $categoryById->save();

            return redirect('/productCategories')->with('message', 'Category info update successfully');
        }else{
            $categoryById = Categories::find($request->id);
            $categoryById->category_name = $request->category_name;
            $categoryById->category_description = $request->category_description;
            $categoryById->status = $request->status;
            $categoryById->save();
            return redirect('/productCategories')->with('message', 'Category info update successfully');
        }
    }
    public function publishCategoryInfo($slug){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $categoryById = Categories::where('slug',$slug)->first();
        $categoryById->status = 1;
        $categoryById->save();
        return redirect('/productCategories')->with('message', 'Category info Published successfully');
    }
    public function unPublishCategoryInfo($slug){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $categoryById = Categories::where('slug',$slug)->first();
        $categoryById->status = 0;
        $categoryById->save();
        return redirect('/productCategories')->with('msg', 'Category info Unpublished successfully');
    }

    public function viewSubCategories(){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $allCategories = Categories::all();
        $allSubCategories=DB::table('sub_categories')
            ->join('categories','categories.id','=','sub_categories.category_id')
            ->select('categories.category_name','sub_categories.*')
            ->get();
        return view('backend.categories.sub-category', ['allSubCategories'=>$allSubCategories,'allCategories'=>$allCategories]);
    }
    public function newSubCategory(Request $request){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'title' => 'required|regex:/^[\pL\s\-]+$/u',
            'description' => 'required',
            'category_id' => 'required',
        ]);
        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->title = $request->title;
        $subcategory->description = $request->description;
        $subcategory->save();

        return redirect('/productSubCategories')->with('message','Sub category info added successfully');
    }
    public function editSubCategory($slug){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $allCategories = Categories::all();
        $SubcategoryById =DB::table('sub_categories')
            ->select('*')
            ->where('slug','=',$slug)
            ->first();
        return view('backend.categories.edit-sub-category',['SubcategoryById'=>$SubcategoryById,'allCategories'=>$allCategories]);
    }
    public function updateSubCategoryInfo(Request $request) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'title' => 'required|regex:/^[\pL\s\-]+$/u',
            'description' => 'required',
            'category_id' => 'required',
        ]);
            $categoryById = SubCategory::find($request->id);
            $categoryById->category_id = $request->category_id;
            $categoryById->title = $request->title;
            $categoryById->description = $request->description;
            $categoryById->status = $request->status;
            $categoryById->save();

            return redirect('/productSubCategories')->with('message', 'Sub-Category info updated successfully');

    }
    public function publishSubCategoryInfo($slug){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $categoryById = SubCategory::where('slug',$slug)->first();
        $categoryById->status = 1;
        $categoryById->save();
        return redirect('/productSubCategories')->with('message', 'Sub-Category info Published successfully');
    }
    public function unPublishSubCategoryInfo($slug){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $categoryById = SubCategory::where('slug',$slug)->first();
        $categoryById->status = 0;
        $categoryById->save();
        return redirect('/productSubCategories')->with('msg', 'Sub-Category info Unpublished successfully');
    }

}

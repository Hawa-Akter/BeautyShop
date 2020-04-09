<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\Brand;
use BeautyShop\Categories;
use BeautyShop\ProductImage;
use BeautyShop\ProductReview;
use BeautyShop\Rating;
use BeautyShop\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use BeautyShop\Product;
use Cart;
use Auth;
use Gate;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showProducts(){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $products=DB::table('products')
            ->join('categories','categories.id','=','products.catId')
            ->join('brands','brands.id','=','products.brandId')
            ->select('products.*','categories.category_name','brands.brand_name')
            ->get();
        $productsCount=Product::count();

        $brands=Brand::all();
        $categories=Categories::all();
        return view('backend.products.products',[
            'brands'=>$brands,
            'categories'=>$categories,
            'products'=>$products,
            'productsCount'=>$productsCount,
        ]);
    }
    public function subcategories(Request $request){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $id=$request->id;
        $subcategories = SubCategory::where('category_id', $id)->get();

        return response(json_encode($subcategories));

    }
    public function newProduct(Request $request){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $request->flush();
        $this->validate($request, [
            'catId'=>'required',
            'brandId'=>'required',
            'subCatId'=>'required',
            'productName' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'productSerial' => 'required|max:30|unique:products',
            'productPrice' => 'required|numeric|digits_between:1,10',
            'discount' => 'required|numeric|max:99|min:0',
            'quantity' => 'required|numeric|min:1|max:100',
            'productDetails' => 'required|max:500',
            'productImage' => 'required',
        ]);

        $productImage = $request->file('productImage');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'product-images/';
        $temp = explode(".", $imageName);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $imgUrl = $directory.$newfilename;
        Image::make($productImage)->save($imgUrl);




        $product = new Product();
        $product->catId = $request->catId;
        $product->subCatId = $request->subCatId;
        $product->brandId = $request->brandId;
        $product->productName = $request->productName;
        $product->productSerial = $request->productSerial;
        $product->productPrice = $request->productPrice;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->productDetails = $request->productDetails;
        $product->productImage = $imgUrl;
        $product->status = 1;
        $product->view = 0;
        $product->save();

        $productID=$product->id;
        $additionalImages=$request->file('additionalImage');
       if ($additionalImages){

           foreach ($additionalImages as $additionalImage){
              //$imgUrl="";
              // dd($additionalImage);
               $imageName = $additionalImage->getClientOriginalName();
               $directory = 'product-images/';
               $imgUrl = $directory.$imageName;
               Image::make($additionalImage)->save($imgUrl);

               $images=new ProductImage();
               $images->product_id=$productID;
               $images->image_name=$imgUrl;
               $images->save();

           }


       }


        return redirect('/beautyProduct')->with('message', 'Product info saved successfully');
        }
    public function unPublishProductInfo($slug) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $productById = Product::where('slug',$slug)->first();
        $productById->status = 0;
        $productById->save();
        return redirect('/beautyProduct')->with('message', 'Product info disabled successfully');
    }
    public function publishProductInfo($slug) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $productById = Product::where('slug',$slug)->first();
        $productById->status = 1;
        $productById->save();
        return redirect('/beautyProduct')->with('message', 'Product info actived successfully');
    }
    public function editProductInfo($slug) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        //$categoryById = Category::where('id', $id)->first();

        $productById =DB::table('products')
            ->select('*')
            ->where('slug','=',$slug)
            ->first();
        return view('backend.products.edit-product', ['productById'=>$productById]);
    }
    public function updateProductInfo(Request $request) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
//        $category = new Category();
        $this->validate($request, [
            'productName' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'productPrice' => 'required|numeric|digits_between:1,10',
            'discount' => 'required|numeric|max:99|min:0',
            'quantity' => 'required|numeric|min:1|max:100',
            'productDetails' => 'required|max:100',
        ]);
        $productImage=$request->file('productImage');

        if($productImage){

            $productById = Product::find($request->id);
            //unlink($productById->productImage);

            $directory='product-images/';
            $imageName=$productImage->getClientOriginalName();
            $imageUrl=$directory.$imageName;
            Image::make($productImage)->save($imageUrl);

            $productById->productName = $request->productName;
            $productById->productPrice = $request->productPrice;
            $productById->discount = $request->discount;
            $productById->quantity = $request->quantity;
            $productById->productDetails = $request->productDetails;
            $productById->productImage = $imageUrl;
            $productById->status = $request->status;
            $productById->save();

        }else {


            $productById = Product::find($request->id);
            $productById->productName = $request->productName;
            $productById->productPrice = $request->productPrice;
            $productById->discount = $request->discount;
            $productById->quantity = $request->quantity;
            $productById->productDetails = $request->productDetails;
            $productById->status = $request->status;
            $productById->save();
        }

        return redirect('/beautyProduct')->with('message', 'Product info updated successfully');
    }

    public function viewProductDetails($slug){
        if (Auth::user()->role!="admin"){
            $updateView=Product::where('slug',$slug)->first();
            $updateView->view=$updateView->view+1;
            $updateView->save();
        }
        $productById=Product::where('slug',$slug)->first();
        $AlreadyRated=DB::table('ratings')
            ->select('id')
            ->where('UserId','=',Auth::user()->id)
            ->where('slug','=',$slug)
            ->count();
        $avgStar=DB::table('ratings')
            ->select('rate')
            ->where('slug','=',$slug)
            ->avg('rate');
        $productReview=DB::table('product_reviews')
            ->join('users','users.id','=','product_reviews.user_id')
            ->select('product_reviews.*','users.name','users.role')
            ->where('product_reviews.product_id','=',$productById->id)
            ->get();
        $allImage=new Product();

        $collection=$allImage->productImages($productById->id);
//dd($collection);
        return view('frontEnd.product.productDetails',['productById'=>$productById,'AlreadyRated'=>$AlreadyRated,'avgStar'=>$avgStar,'productReview'=>$productReview,'collection'=>$collection]);

    }
    public function storeRatingOnProduct(Request $request){
        $rating=new Rating();
        $rating->UserId=$request->UserID;
        $rating->slug=$request->ProductSlug;
        $rating->rate=$request->rate;
        $rating->save();
    }
    public function AddProductToCart($slug){
        $addProduct=Product::where('slug',$slug)->first();

        if($addProduct->quantity<1){
            return back()->with('message','Your selected product is out of stock');

        }else {
            if ($addProduct->discount > 0) {
                Cart::instance('shopping')->add([
                    'id' => $addProduct->id,
                    'name' => $addProduct->productName,
                    'qty' => 1,
                    'price' => $addProduct->productPrice - $addProduct->productPrice * $addProduct->discount / 100,
                    'options' => [
                        'productImage' => $addProduct->productImage,
                        'discount' => $addProduct->discount,
                        'orgPrice' => $addProduct->productPrice,
                        'slug' => $addProduct->slug,
                        'details' => $addProduct->productDetails,
                        'to' => 'shop',
                    ],
                ]);
            } else {
                Cart::instance('shopping')->add([
                    'id' => $addProduct->id,
                    'name' => $addProduct->productName,
                    'qty' => 1,
                    'price' => $addProduct->productPrice,
                    'options' => [
                        'productImage' => $addProduct->productImage,
                        'discount' => $addProduct->discount,
                        'slug' => $addProduct->slug,
                        'orgPrice' => $addProduct->price,
                        'details' => $addProduct->productDetails,
                    ],
                ]);
            }
        }
      return back();
    }
    public function CartPage(){
        $allCartProduct=Cart::instance('shopping')->content();
       // dd($allCartProduct);
        return view('frontEnd.product.cart-page',['allCartProduct'=>$allCartProduct]);
    }
    public function removeCartProduct($rowId){
        Cart::instance('shopping')->remove($rowId);
        return back()->with('message', 'Cart product removed successfully');
    }
    public function updateCart(Request $request){

        $product=Product::find($request->id);



        $quantity=$product->quantity;
        if($quantity<1){

            return back()->with('messageDanger', 'Your Desire Quantity is Out Of Stock');
        }else {
            if($product->quantity>$request->qty) {
                Cart::instance('shopping')->update($request->rowId, $request->qty);
                return redirect('/cart-products')->with('message', 'Cart product info update successfully');

            }else{
                return redirect('/cart-products')->with('messageDanger', 'Your Product quantity is not available Right Now');
            }


        }
    }
    public function showCheckOut(){
        $userInfo=Auth::user();
        $latestShipping=DB::table('shippings')
            ->join('orders','orders.shipping_id','=','shippings.id')
            ->where('orders.customer_id','=',$userInfo->id)
            ->select('shippings.*')
            ->latest()
            ->first();

        $checkOutProducts=Cart::instance('shopping')->content();


        $subTotal=Cart::instance('shopping')->subtotal();
        $Total=Cart::instance('shopping')->total();
        return view('frontEnd.product.check-out',['checkOutProducts'=>$checkOutProducts,
            'subTotal'=>$subTotal,
            'Total'=>$Total,
            'userInfo'=>$userInfo,
            'latestShipping'=>$latestShipping
        ]);
    }
    public function newReview(Request $request){
        $this->validate($request, [
            'review_title'=>'required',
            'detail_review'=>'required',
        ]);
    $productReview=new ProductReview();
    $productReview->product_id=$request->product_id;
    $productReview->user_id=Auth::user()->id;
    $productReview->review_title=$request->review_title;
    $productReview->detail_review=$request->detail_review;
    $productReview->save();
    return back();

    }


}

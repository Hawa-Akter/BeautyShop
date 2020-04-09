<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\Brand;
use BeautyShop\Categories;
use BeautyShop\MarketOrder;
use BeautyShop\MarketOrderDetails;
use BeautyShop\MarketProduct;
use BeautyShop\MarketProductImage;
use BeautyShop\PaymentInfo;
use BeautyShop\Product;
use BeautyShop\ProductImage;
use BeautyShop\Shipping;
use BeautyShop\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Cart;
use PDF;
use View;
use App;
Use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewMarketPlace(){

        $allProducts=MarketProduct::where('status',1)->get();
        $allBrands=Brand::where('status',1)->get();
        $categories=Categories::where('status',1)->with('NavigationSubCategory')->get();
        $avgRatings=New Product();
        return view('frontEnd.market.marketPlace',['allProducts'=>$allProducts,
            'avgRatings'=>$avgRatings,
            'categories'=>$categories,
            'allBrands'=>$allBrands,

        ]);
    }
    public function newMarketProduct(Request $request){

        $request->flush();
        $this->validate($request, [
            'catId'=>'required',
            'brandId'=>'required',
            'productName' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'productOrigin' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'productSerial' => 'required|max:30|unique:products',
            'productPrice' => 'required|numeric|digits_between:1,10',
            'discount' => 'required|numeric|max:99|min:0',
            'quantity' => 'required|numeric|min:1|max:5',
            'productDetails' => 'required|max:500',
            'productImage' => 'required',
        ]);

       // dd('adas');
        $productImage = $request->file('productImage');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'market-product-images/';
        $temp = explode(".", $imageName);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $imgUrl = $directory.$newfilename;
        Image::make($productImage)->save($imgUrl);




        $product = new MarketProduct();
        $product->category_id = $request->catId;
        $product->brand_id = $request->brandId;
        $product->user_id = Auth::user()->id;
        $product->productName = $request->productName;
        $product->productOrigin = $request->productOrigin;
        $product->productSerial = $request->productSerial;
        $product->productPrice = $request->productPrice;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->productDetails = $request->productDetails;
        $product->productImage = $imgUrl;
        $product->status = 1;
        $product->save();

        $productID=$product->id;
        $additionalImages=$request->file('additionalImage');
        if ($additionalImages){

            foreach ($additionalImages as $additionalImage){
                //$imgUrl="";
                // dd($additionalImage);
                $imageName = $additionalImage->getClientOriginalName();
                $directory = 'market-product-images/';
                $imgUrl = $directory.$imageName;
                Image::make($additionalImage)->save($imgUrl);

                $images=new MarketProductImage();
                $images->market_product_id=$productID;
                $images->image_name=$imgUrl;
                $images->save();

            }


        }


        return back()->with('message', 'Product info saved successfully');
    }
    public function viewProductDetails($slug){
        $productById=DB::table('market_products')
            ->join('users','users.id','=','market_products.user_id')
            ->select('market_products.*','users.name','users.email')
            ->first();
        $userName=User::where('id',$productById->user_id)->first();
        $allImage=new MarketProductImage();
       // dd($productById->id);
        $collection=$allImage->productImages($productById->id);

        return view('frontEnd.market.marketProductDetails',['productById'=>$productById,'collection'=>$collection,'userName'=>$userName]);

    }
    public function AddProductToCart($slug){
        $addProduct=MarketProduct::where('slug',$slug)->first();

            Cart::instance('market')->add([
                'id' => $addProduct->id,
                'name' => $addProduct->productName,
                'qty' => 1,
                'price' => $addProduct->productPrice - $addProduct->productPrice * $addProduct->discount / 100,
                'options' => [
                    'productImage' => $addProduct->productImage,
                    'slug' => $addProduct->slug,
                    'orgPrice' => $addProduct->price,
                    'details' => $addProduct->productDetails,
                    'discount' => $addProduct->discount,
                    'owner'=>$addProduct->user_id,
                ],
            ]);

        return back();
    }
    public function CartPage(){
        $allCartProduct=Cart::instance('market')->content();
        // dd($allCartProduct);
        return view('frontEnd.market.market-cart',['allCartProduct'=>$allCartProduct]);
    }
    public function removeCartProductOfMarket($rowId){
        Cart::instance('market')->remove($rowId);
        return back()->with('message', 'Cart product removed successfully');
    }
    public function showMarketCheckOut(){
        $userInfo=Auth::user();
        $latestShipping=DB::table('shippings')
            ->join('market_orders','market_orders.shipping_id','=','shippings.id')
            ->where('market_orders.customer_id','=',$userInfo->id)
            ->select('shippings.*')
            ->latest()
            ->first();

        $checkOutProducts=Cart::instance('market')->content();


        $subTotal=Cart::instance('market')->subtotal();
        $Total=Cart::instance('market')->total();
        return view('frontEnd.market.market-checkout',['checkOutProducts'=>$checkOutProducts,
            'subTotal'=>$subTotal,
            'Total'=>$Total,
            'userInfo'=>$userInfo,
            'latestShipping'=>$latestShipping
        ]);
    }
    public function confirmPurchase(Request $request){

        if ( $totalOrder=Cart::instance('market')->count()<1){
            Return back()->with('mess','No product is Added on Cart!');
        }
        $this->validate($request, [
            'first_name' => 'required',
            'town' => 'required',
            'state' => 'required',
            'postCode' => 'required',
            'country' => 'required',
            'address1' => 'required',
            'phone' => 'required|digits:11|numeric',
            'card_number' => 'required|digits:16|numeric',
            'cvc' => 'required|digits:3|numeric',
            'owner_name' => 'required',
            'ex_date' => 'required',
        ]);

        $payment=new PaymentInfo();
        $payment->card_number=$request->card_number;
        $payment->ex_date=$request->ex_date;
        $payment->cvc=$request->cvc;
        $payment->owner_name=$request->owner_name;
        $payment->save();
        $paymentId=$payment->id;

        $shipping=new Shipping();
        $shipping->first_name=$request->first_name;
        $shipping->email=$request->email;
        $shipping->address1=$request->address1;
        $shipping->address2=$request->address2;
        $shipping->town=$request->town;
        $shipping->state=$request->state;
        $shipping->postCode=$request->postCode;
        $shipping->phone=$request->phone;
        $shipping->country=$request->country;
        $shipping->save();
        $shippingId=$shipping->id;

        $totalOrder=Cart::instance('market')->total();
        $totalOrderCost = floatval(str_replace(',', '', str_replace('.', '.', $totalOrder)));$totalOrderCost = floatval(str_replace(',', '', str_replace('.', '.', $totalOrder)));

        $order= new MarketOrder();
        $order->customer_id = Auth::user()->id;
        $order->shipping_id = $shippingId;
        $order->payment_id = $paymentId;
        $order->total_order_cost =$totalOrderCost;
        $order->status = 0;
        $order->save();
        $orderId = $order->id;

        $cartProducts = Cart::instance('market')->content();
        foreach ($cartProducts as $cartProduct) {
            $orders = new MarketOrderDetails();
            $orders->order_id = $orderId;
            $orders->product_id = $cartProduct->id;
            $orders->owner_id = $cartProduct->options->owner;
            $orders->net_price = $cartProduct->price;
            $orders->quantity = $cartProduct->qty;
            $orders->product_discount = $cartProduct->options->discount;
            $orders->total_amount = $cartProduct->price*$cartProduct->qty;
            $orders->save();
            DB::table('market_products')->where('id',$cartProduct->id)->decrement('quantity', $cartProduct->qty);
        }

        Cart::destroy();

        return redirect('/market-print-invoice/'.$orderId);
    }
    public function printMarketInvoice($id){
        $orderId=$id;
        $order=MarketOrder::find($orderId);
        if(Auth::user()->id!=$order->customer_id){
            abort('404','you cannot access here');
        }

        $orderProducts=DB::table('market_order_details')
            ->join('market_products','market_products.id','=','market_order_details.product_id')
            ->select('market_products.*','market_order_details.*')
            ->where('market_order_details.order_id','=',$orderId)
            ->get();
        $paymentInfo=DB::table('market_orders')
            ->join('payment_infos','market_orders.payment_id','payment_infos.id')
            ->select('payment_infos.*')
            ->where('market_orders.id','=',$orderId)
            ->first();
        $shipping=Shipping::find($order->shipping_id);
        $data = array_merge(['order' => $order, 'orderProducts' => $orderProducts,'shipping'=>$shipping,'paymentInfo'=>$paymentInfo]);

        $invoice_render = View::make('Invoice.market-Invoice-content', $data)->render();


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();

    }
    public function updateCart(Request $request){

        $product=MarketProduct::find($request->id);



        $quantity=$product->quantity;
        if($quantity<1){

            return back()->with('messageDanger', 'Your Desire Quantity is Out Of Stock');
        }else {
            if($product->quantity>$request->qty) {
                Cart::instance('shopping')->update($request->rowId, $request->qty);
                return redirect('/market-cart-products')->with('message', 'Cart product info update successfully');

            }else{
                return redirect('/market-cart-products')->with('messageDanger', 'Your Product quantity is not available Right Now');
            }


        }
    }



}

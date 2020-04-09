<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\MarketOrder;
use BeautyShop\Order;
use BeautyShop\OrderDetails;
use BeautyShop\Shipping;
use BeautyShop\User;
use Illuminate\Http\Request;
Use Cart;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Gate;
use PDF;
use View;

class OrderController extends Controller
{
    public function ConfirmOrder(Request $request){
        if ( $totalOrder=Cart::instance('shopping')->count()<1){
            Return back()->with('mess','No product is Added on Cart!');
        }
        $this->validate($request, [
            'first_name' => 'required',
            'town' => 'required',
            'state' => 'required',
            'postCode' => 'required',
            'country' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'phone' => 'required|digits:11|numeric',
        ]);
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

        $totalOrder=Cart::instance('shopping')->total();
        $totalOrderCost = floatval(str_replace(',', '', str_replace('.', '.', $totalOrder)));$totalOrderCost = floatval(str_replace(',', '', str_replace('.', '.', $totalOrder)));

        $order= new Order();
        $order->customer_id = Auth::user()->id;
        $order->shipping_id = $shippingId;
        $order->total_order_cost =$totalOrderCost;
        $order->status = 0;
        $order->save();
        $orderId = $order->id;

        $cartProducts = Cart::instance('shopping')->content();
        foreach ($cartProducts as $cartProduct) {
            $orders = new OrderDetails();
            $orders->order_id = $orderId;
            $orders->product_id = $cartProduct->id;
            $orders->net_price = $cartProduct->price;
            $orders->quantity = $cartProduct->qty;
            $orders->product_discount = $cartProduct->options->discount;
            $orders->total_amount = $cartProduct->price*$cartProduct->qty;
            $orders->save();
            DB::table('products')->where('id',$cartProduct->id)->decrement('quantity', $cartProduct->qty);
        }

        Cart::destroy();

        return redirect('/print-invoice/'.$orderId);
    }
    public function printInvoice($id){
        $orderId=$id;
        $order=Order::find($orderId);
        if(Auth::user()->id!=$order->customer_id){
            abort('404','you cannot access here');
        }

        $orderProducts=DB::table('order_details')
            ->join('products','products.id','=','order_details.product_id')
            ->select('products.*','order_details.*')
            ->where('order_details.order_id','=',$orderId)
            ->get();

        $shipping=Shipping::find($order->shipping_id);
        $data = array_merge(['order' => $order, 'orderProducts' => $orderProducts,'shipping'=>$shipping]);

        $invoice_render = View::make('Invoice.invoice-content', $data)->render();


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();

    }

    public function viewOrder(){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $customerOrder=DB::table('orders')
            ->select('*')
            ->orderby('id','desc')
            ->get();

        //dd($customerOrder);
        return view('backend.order.view-order',['customerOrder'=>$customerOrder]);
    }
    public function allMarketOrder(){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $customerOrder=DB::table('market_orders')
            ->select('*')
            ->orderby('id','desc')
            ->get();

        //dd($customerOrder);
        return view('backend.order.market-view-order',['customerOrder'=>$customerOrder]);
    }
    public function confirmOrderDelivery($id){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $OrderById = Order::find($id);
        $OrderById->status = 1;
        $OrderById->save();

        return back();
    }
    public function confirmMarketOrderDelivery($id){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $OrderById = MarketOrder::find($id);
        $OrderById->status = 1;
        $OrderById->save();

        return back();
    }
    public function viewOrderDetails($id){
        $customerOrder=Order::find($id);

        $ShippingDetails=DB::table('shippings')
            ->select('*')
            ->where('id','=',$customerOrder->shipping_id)
            ->first();
        $customer=User::find($customerOrder->customer_id);
        $products=DB::table('order_details')
            ->join('products','products.id','=','order_details.product_id')
            ->select('order_details.*','products.productName','products.productPrice')
            ->where('order_id','=',$customerOrder->id)
            ->get();
        return view('backend.order.order-details',['customerOrder'=>$customerOrder,'ShippingDetails'=>$ShippingDetails,'customer'=>$customer,'products'=>$products]);
    }
    public function viewOrderDetailsOfMarket($id){
        $customerOrder=MarketOrder::find($id);

        $ShippingDetails=DB::table('shippings')
            ->select('*')
            ->where('id','=',$customerOrder->shipping_id)
            ->first();
        $customer=User::find($customerOrder->customer_id);
        $products=DB::table('market_order_details')
            ->join('market_products','market_products.id','=','market_order_details.product_id')
            ->join('users','users.id','=','market_order_details.owner_id')
            ->select('market_order_details.*','market_products.productName','market_products.productPrice','users.id as uid','users.name')
            ->where('market_order_details.order_id','=',$customerOrder->id)
            ->get();
        return view('backend.order.market-order-details',['customerOrder'=>$customerOrder,
            'ShippingDetails'=>$ShippingDetails,
            'customer'=>$customer,
            'products'=>$products,

            ]);
    }
}

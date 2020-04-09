<?php

namespace BeautyShop\Http\Controllers;


use BeautyShop\User;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class AdminWelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDashboard(){

        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $usersCount=DB::table('users')
            ->where('role','=',"user")
            ->count();
        $beautitianCount=DB::table('users')
            ->where('role','=',"beautitian")
            ->count();
        $TotalOrderCost=DB::table('orders')
            ->where('status','=',1)
            ->sum('total_order_cost');
        $janOrder=DB::table('orders')
            ->whereMonth('created_at', '1')
            ->sum('total_order_cost');
        $janOrderWithoutTax=DB::table('order_details')
            ->join('orders','orders.id','=','order_details.order_id')
            ->where('orders.status','=',1)
            ->whereMonth('orders.created_at','=',1)
            ->sum('total_amount');
        $JanTax=$janOrder-$janOrderWithoutTax;
        $febOrder=DB::table('orders')
            ->whereMonth('created_at', '2')
            ->sum('total_order_cost');
        $febOrderWithoutTax=DB::table('order_details')
            ->join('orders','orders.id','=','order_details.order_id')
            ->where('orders.status','=',1)
            ->whereMonth('orders.created_at','=',2)
            ->sum('total_amount');
        $febTax=$febOrder-$febOrderWithoutTax;
        $marOrder=DB::table('orders')
            ->whereMonth('created_at', '3')
            ->sum('total_order_cost');
        $marchOrderWithoutTax=DB::table('order_details')
            ->join('orders','orders.id','=','order_details.order_id')
            ->where('orders.status','=',1)
            ->whereMonth('orders.created_at','=',3)
            ->sum('total_amount');
        $marchTax=$marOrder-$marchOrderWithoutTax;
        $aprOrder=DB::table('orders')
            ->whereMonth('created_at', '4')
            ->sum('total_order_cost');
        $aprOrderWithoutTax=DB::table('order_details')
            ->join('orders','orders.id','=','order_details.order_id')
            ->where('orders.status','=',1)
            ->whereMonth('orders.created_at','=',4)
            ->sum('total_amount');
        $aprilTax=$aprOrder-$aprOrderWithoutTax;

        $mayOrder=DB::table('orders')
            ->whereMonth('created_at', '5')
            ->sum('total_order_cost');
        $mayOrderWithoutTax=DB::table('order_details')
            ->join('orders','orders.id','=','order_details.order_id')
            ->where('orders.status','=',1)
            ->whereMonth('orders.created_at','=',5)
            ->sum('total_amount');
        $mayTax=$mayOrder-$mayOrderWithoutTax;

        $janMarketOrder=DB::table('market_orders')
            ->whereMonth('created_at', '1')
            ->sum('total_order_cost');
        $febMarketOrder=DB::table('market_orders')
            ->whereMonth('created_at', '2')
            ->sum('total_order_cost');
        $marMarketOrder=DB::table('market_orders')
            ->whereMonth('created_at', '3')
            ->sum('total_order_cost');
        $aprMarketOrder=DB::table('market_orders')
            ->whereMonth('created_at', '4')
            ->sum('total_order_cost');
        $mayMarketOrder=DB::table('market_orders')
            ->whereMonth('created_at', '5')
            ->sum('total_order_cost');

        $TotalMarketCost=DB::table('market_orders')
            ->where('status','=',1)
            ->sum('total_order_cost');

        $blogsCount=DB::table('blogs')
            ->count('id');
        $orderCostWithoutTax=DB::table('order_details')
            ->join('orders','orders.id','=','order_details.order_id')
            ->where('orders.status','=',1)
            ->sum('total_amount');
        $totalTax=$TotalOrderCost-$orderCostWithoutTax;
        $totalRevenue=DB::table('accounts')
            ->sum('commission');
        $janRevenue=DB::table('accounts')
            ->whereMonth('created_at', '1')
            ->sum('commission');
        $febRevenue=DB::table('accounts')
            ->whereMonth('created_at', '2')
            ->sum('commission');
        $marchRevenue=DB::table('accounts')
            ->whereMonth('created_at', '3')
            ->sum('commission');
        $aprilRevenue=DB::table('accounts')
            ->whereMonth('created_at', '4')
            ->sum('commission');
        $mayRevenue=DB::table('accounts')
            ->whereMonth('created_at', '5')
            ->sum('commission');
        $totalComment=DB::table('blog_comments')
            ->count('id');

        $janComment=DB::table('blog_comments')
            ->whereMonth('created_at', '1')
            ->count('id');
        $febComment=DB::table('blog_comments')
            ->whereMonth('created_at', '2')
            ->count('id');
        $marchComment=DB::table('blog_comments')
            ->whereMonth('created_at', '3')
            ->count('id');
        $aprilComment=DB::table('blog_comments')
            ->whereMonth('created_at', '4')
            ->count('id');
        $mayComment=DB::table('blog_comments')
            ->whereMonth('created_at', '5')
            ->count('id');

        $totalBlog=DB::table('blogs')
            ->count('id');

        $JanBlog=DB::table('blogs')
            ->whereMonth('created_at', '1')
            ->count('id');
        $FebBlog=DB::table('blogs')
            ->whereMonth('created_at', '2')
            ->count('id');
        $marBlog=DB::table('blogs')
            ->whereMonth('created_at', '3')
            ->count('id');
        $aprBlog=DB::table('blogs')
            ->whereMonth('created_at', '4')
            ->count('id');
        $mayBlog=DB::table('blogs')
            ->whereMonth('created_at', '5')
            ->count('id');

        return view('backend.Home.dashboard',['usersCount'=>$usersCount,
            'beautitianCount'=>$beautitianCount,
            'TotalOrderCost'=>$TotalOrderCost,
            'blogsCount'=>$blogsCount,
            'TotalMarketCost'=>$TotalMarketCost,
            'totalTax'=>$totalTax,
            'totalRevenue'=>$totalRevenue,
            'totalComment'=>$totalComment,
            'totalBlog'=>$totalBlog,
            'janOrder'=>$janOrder,
            'febOrder'=>$febOrder,
            'marOrder'=>$marOrder,
            'aprOrder'=>$aprOrder,
            'mayOrder'=>$mayOrder,
            'janMarketOrder'=>$janMarketOrder,
            'febMarketOrder'=>$febMarketOrder,
            'marMarketOrder'=>$marMarketOrder,
            'aprMarketOrder'=>$aprMarketOrder,
            'mayMarketOrder'=>$mayMarketOrder,
            'JanTax'=>$JanTax,
            'febTax'=>$febTax,
            'marchTax'=>$marchTax,
            'aprilTax'=>$aprilTax,
            'mayTax'=>$mayTax,
            'janRevenue'=>$janRevenue,
            'febRevenue'=>$febRevenue,
            'marchRevenue'=>$marchRevenue,
            'aprilRevenue'=>$aprilRevenue,
            'mayRevenue'=>$mayRevenue,
            'JanBlog'=>$JanBlog,
            'FebBlog'=>$FebBlog,
            'marBlog'=>$marBlog,
            'aprBlog'=>$aprBlog,
            'mayBlog'=>$mayBlog,
            'janComment'=>$janComment,
            'febComment'=>$febComment,
            'marchComment'=>$marchComment,
            'aprilComment'=>$aprilComment,
            'mayComment'=>$mayComment,
            ]);
    }
    public function viewAddBeautitian(){
        $users=User::where('role','user')->get();
        $beautitians=User::where('role','beautitian')->get();
        return view('backEnd.users.addBeautitian',['users'=>$users,'beautitians'=>$beautitians]);
    }
    public function setBeautitian(Request $request){
        $users=User::find($request->user_id);
        $users->role="beautitian";
        $users->save();
        return back();
    }
    public function viewAllUser(){
        $users=User::where('role','user')->get();
        return view('backend.users.all-users',['users'=>$users]);
    }


}

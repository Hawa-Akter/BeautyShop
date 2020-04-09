<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\Account;
use BeautyShop\BeautitianProfile;
use BeautyShop\BeautitianRating;
use BeautyShop\Product;
use BeautyShop\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
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
    public function ProfileView(){
        $profileInfo=DB::table('beautitian_profiles')
            ->select('*')
            ->where('user_id','=',Auth::user()->id)
            ->first();
        $userInfo=DB::table('users')
            ->select('*')
            ->where('id','=',Auth::user()->id)
            ->first();
        $starRate=new BeautitianRating();
        $star=$starRate->AvgBeautitianRate($profileInfo->user_id);
        return view('frontEnd.profile.beautytianProfile',['profileInfo'=>$profileInfo,'userInfo'=>$userInfo,'star'=>$star]);
    }
    public function UpdateProfile(Request $request){
        $request->flush();
        $this->validate($request, [
            'name'=>'required',
            'profession'=>'required',
            'skill_one'=>'required',
        ]);
        $checkProfileInfo=DB::table('beautitian_profiles')
            ->where('user_id','=',Auth::user()->id)
            ->count();


        $profilePicture = $request->file('photo');



       // dd($checkProfileInfo);
        if ($checkProfileInfo>0){
            $editName=User::find(Auth::user()->id);
            $editName->name=$request->name;
            $editName->save();
            if ($profilePicture){
                $imageName = $profilePicture->getClientOriginalName();
                $directory = 'profilePictures/';
                $temp = explode(".", $imageName);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                $imgUrl = $directory.$newfilename;
                Image::make($profilePicture)->resize(240,160)->save($imgUrl);

                $updateProfile=BeautitianProfile::find($request->id);
                $updateProfile->user_id=Auth::user()->id;
                $updateProfile->profession=$request->profession;
                $updateProfile->photo=$imgUrl;
                $updateProfile->skill_one=$request->skill_one;
                $updateProfile->skill_two=$request->skill_two;
                $updateProfile->skill_three=$request->skill_three;
                $updateProfile->web_link=$request->web_link;
                $updateProfile->youtube_link=$request->youtube_link;
                $updateProfile->save();
                return back()->with('mess','Profile Updated Successfully!');

            }else{
                $updateProfile=BeautitianProfile::find($request->id);
                $updateProfile->user_id=Auth::user()->id;
                $updateProfile->profession=$request->profession;
                $updateProfile->skill_one=$request->skill_one;
                $updateProfile->skill_two=$request->skill_two;
                $updateProfile->skill_three=$request->skill_three;
                $updateProfile->web_link=$request->web_link;
                $updateProfile->youtube_link=$request->youtube_link;
                $updateProfile->save();
                return back()->with('mess','Profile Updated Successfully!');

            }
        }else{
            $editName=User::find(Auth::user()->id);
            $editName->name=$request->name;
            $editName->save();
            if ($profilePicture){
                $imageName = $profilePicture->getClientOriginalName();
                $directory = 'profilePictures/';
                $temp = explode(".", $imageName);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                $imgUrl = $directory.$newfilename;
                Image::make($profilePicture)->save($imgUrl);

                $updateProfile=new BeautitianProfile();
                $updateProfile->user_id=Auth::user()->id;
                $updateProfile->profession=$request->profession;
                $updateProfile->photo=$imgUrl;
                $updateProfile->skill_one=$request->skill_one;
                $updateProfile->skill_two=$request->skill_two;
                $updateProfile->skill_three=$request->skill_three;
                $updateProfile->web_link=$request->web_link;
                $updateProfile->youtube_link=$request->youtube_link;
                $updateProfile->save();
                return back()->with('mess','Profile Updated Successfully!');
            }else{
                $updateProfile=new BeautitianProfile();
                $updateProfile->user_id=Auth::user()->id;
                $updateProfile->profession=$request->profession;
                $updateProfile->skill_one=$request->skill_one;
                $updateProfile->skill_two=$request->skill_two;
                $updateProfile->skill_three=$request->skill_three;
                $updateProfile->web_link=$request->web_link;
                $updateProfile->youtube_link=$request->youtube_link;
                $updateProfile->save();
                return back()->with('mess','Profile Updated Successfully!');
            }


        }



    }
    public function showCustomerProfile(){

        $Orders=DB::table('orders')
            ->select('*')
            ->where('customer_id','=',Auth::user()->id)
            ->get();
        $CurrentStock=DB::table('market_products')
            ->select('*')
            ->where('user_id','=',Auth::user()->id)
            ->where('quantity','>=',1)
            ->get();
        $sellHistory=DB::table('market_order_details')
            ->join('market_products','market_products.id','=','market_order_details.product_id')
            ->join('users','market_order_details.owner_id','=','users.id')
            ->select('market_order_details.*','market_products.productName','users.name')
            ->where('market_products.user_id','=',Auth::user()->id)
            ->get();
        $netIncome=DB::table('market_order_details')
            ->join('market_products','market_products.id','=','market_order_details.product_id')
            ->join('users','market_order_details.owner_id','=','users.id')
            ->join('market_orders','market_orders.id','=','market_order_details.order_id')
            ->where('market_products.user_id','=',Auth::user()->id)
            ->where('market_orders.status','=',1)
            ->sum('market_order_details.total_amount');
        $PendingForApproval=DB::table('market_order_details')
            ->join('market_products','market_products.id','=','market_order_details.product_id')
            ->join('users','market_order_details.owner_id','=','users.id')
            ->join('market_orders','market_orders.id','=','market_order_details.order_id')
            ->where('market_products.user_id','=',Auth::user()->id)
            ->where('market_orders.status','=',0)
            ->sum('market_order_details.total_amount');

        $WithdrawMoney=DB::table('accounts')
            ->where('customer_id','=',Auth::user()->id)
            ->sum('amount_of_withdraw');

        $OnlyWithdraw=DB::table('accounts')
            ->where([['customer_id','=',Auth::user()->id],['status','=',0]])
            ->sum('amount_of_withdraw');

        return view('frontEnd.Account.user-profile',['Orders'=>$Orders,
            'CurrentStock'=>$CurrentStock,
            'sellHistory'=>$sellHistory,
            'netIncome'=>$netIncome,
            'WithdrawMoney'=>$WithdrawMoney,
            'OnlyWithdraw'=>$OnlyWithdraw,
            'PendingForApproval'=>$PendingForApproval,

        ]);

    }
    public function saveWithDraw(Request $request)
    {
        $this->validate($request, [
            'bank_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'account_name' => 'required',
            'account_number' => 'required|digits:16|numeric',
            'amount_of_withdraw' => 'required|numeric',
        ]);
        $withDraw = new Account();
        $withDraw->customer_id = $request->customer_id;
        $withDraw->bank_name = $request->bank_name;
        $withDraw->account_name = $request->account_name;
        $withDraw->account_number = $request->account_number;
        $withDraw->amount_of_withdraw = $request->amount_of_withdraw;
        $withDraw->commission = $request->commission;
        $withDraw->save();

        return back();
    }
    public function beautitans(){

        $beautitian=DB::table('beautitian_profiles')
            ->join('users','users.id','=','beautitian_profiles.user_id')
            ->select('beautitian_profiles.*','users.name')
            ->get();
        $obj=new BeautitianRating();

        return view('frontEnd.beautitan.all-beautitian',['beautitian'=>$beautitian,'obj'=>$obj]);
    }
    public function beautitianDetailsById($id){
        $profileInfo=DB::table('beautitian_profiles')
            ->select('*')
            ->where('user_id','=',$id)
            ->first();
        $userInfo=DB::table('users')
            ->select('*')
            ->where('id','=',$id)
            ->first();
        $allBlogs=DB::table('blogs')
            ->join('users','blogs.user_id','=','users.id')
            ->select('blogs.*','users.name')
            ->where('blogs.user_id','=',$id)
            ->orderBy('created_at','desc')
            ->get();
        $starRate=new BeautitianRating();
        $star=$starRate->AvgBeautitianRate($id);
        return view('frontEnd.beautitan.beautitian-details',['profileInfo'=>$profileInfo,
            'userInfo'=>$userInfo,
            'allBlogs'=>$allBlogs,
            'star'=>$star,
        ]);

    }
    public function storeRatingOnbeautitian(Request $request){
        $rating=new BeautitianRating();
        $rating->user_id=$request->UserID;
        $rating->beautitian_id=$request->BId;
        $rating->rate=$request->rate;
        $rating->save();
    }
}

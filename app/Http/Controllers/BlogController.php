<?php

namespace BeautyShop\Http\Controllers;

use BeautyShop\Blog;
use BeautyShop\BlogComment;
use BeautyShop\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ViewBlog(){

        $allBlogs=DB::table('blogs')
            ->join('users','blogs.user_id','=','users.id')
            ->select('users.name','blogs.*')
            ->where('status','=',1)
            ->orderBy('blogs.id','desc')
            ->get();
        $recentPosts=DB::table('blogs')
            ->select('*')
            ->orderBy('id','desc')
            ->where('status','=',1)
            ->limit(3)
            ->get();


        return view('frontEnd.blog.blog-contents',['allBlogs'=>$allBlogs,'recentPosts'=>$recentPosts]);
    }
    public function addNewBlog(Request $request){

        $request->flush();
        $this->validate($request, [
            'title'=>'required',
            'details_blog'=>'required',
        ]);
        $video=null;
        if (isset($request->video_link)){
            $url = $request->video_link;
            preg_match(
                '/[\\?\\&]v=([^\\?\\&]+)/',
                $url,
                $matches
            );
            $video = $matches[1];

        }

        if (isset($request->photo)) {
            $blogImage = $request->file('photo');
            $imageName = $blogImage->getClientOriginalName();
            $directory = 'product-images/';
            $temp = explode(".", $imageName);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $imgUrl = $directory . $newfilename;
            Image::make($blogImage)->save($imgUrl);

            $blog = new Blog();
            $blog->title = $request->title;
            $blog->user_id =Auth::user()->id;
            $blog->category = $request->topic;
            $blog->blog_image = $imgUrl;
            $blog->video_link = $video;
            $blog->status =1;
            $blog->details_blog = $request->details_blog;
            $blog->save();
        }else{
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->user_id =Auth::user()->id;
            $blog->category = $request->topic;
            $blog->video_link = $video;
            $blog->status =1;
            $blog->details_blog = $request->details_blog;
            $blog->save();
        }
        return redirect('/blog')->with('mess','Your Blog added Successfully!');
    }
    public function UpdateBlog(Request $request){

        $this->validate($request, [
            'title'=>'required',
            'details_blog'=>'required',
        ]);


        if (isset($request->photo)) {
            $blogImage = $request->file('photo');
            $imageName = $blogImage->getClientOriginalName();
            $directory = 'product-images/';
            $temp = explode(".", $imageName);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $imgUrl = $directory . $newfilename;
            Image::make($blogImage)->save($imgUrl);

            $blog = Blog::find($request->id);
            $blog->title = $request->title;
            $blog->user_id =Auth::user()->id;
            $blog->category = $request->topic;
            $blog->blog_image = $imgUrl;
            $blog->details_blog = $request->details_blog;
            $blog->save();
        }else{
            $blog = Blog::find($request->id);
            $blog->title = $request->title;
            $blog->user_id =Auth::user()->id;
            $blog->category = $request->topic;
            $blog->details_blog = $request->details_blog;
            $blog->save();
        }
        return redirect('/blog')->with('mess','Your Blog Updated Successfully!');
    }
    public function blogDetailsById($slug){

        $BlogById=DB::table('blogs')
            ->join('users','blogs.user_id','=','users.id')
            ->select('users.name','blogs.*')
            ->where('blogs.slug','=',$slug)
            ->first();

        if (Auth::user()->id!=$BlogById->user_id){
            $updateView=Blog::where('slug',$slug)->first();
            $updateView->view=$updateView->view+1;
            $updateView->save();
        }
        $checkRate=DB::table('beautitian_ratings')
            ->select('*')
            ->where('beautitian_ratings.beautitian_id','=',$BlogById->user_id)
            ->where('beautitian_ratings.user_id','=',Auth::user()->id)
            ->count();


        $BlogById2=DB::table('blogs')
            ->join('users','blogs.user_id','=','users.id')
            ->join('beautitian_profiles','beautitian_profiles.user_id','=','users.id')
            ->select('users.name','blogs.*','beautitian_profiles.photo')
            ->where('blogs.slug','=',$slug)
            ->first();

        $recentPosts=DB::table('blogs')
            ->select('*')
            ->orderBy('id','desc')
            ->limit(3)
            ->get();
        $allComments=New BlogComment();
        $taggs=DB::table('blogs')
            ->select('category')
            ->get();

        return view('frontEnd.blog.blog-details',['BlogById2'=>$BlogById2,
            'allComments'=>$allComments,
            'recentPosts'=>$recentPosts,
            'taggs'=>$taggs,
            'checkRate'=>$checkRate,

        ]);
    }
    public function createComment(Request $request){

        $newComment=new BlogComment();
        $newComment->blog_id=$request->blog_id;
        $newComment->user_id=Auth::user()->id;
        $newComment->subject=$request->subject;
        $newComment->comment_description=$request->comment;
        $newComment->save();

        return back()->with('cmnt','Comment successfully posted');

    }
    public function deleteBlog($slug){
        $delete=Blog::where('slug',$slug)->first();
        $delete->status=0;
        $delete->save();
        return redirect('/blog');
    }
}

<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        return redirect('/posts');
    }
    public function show($slug){
        
        $category = Category::where('slug','=',$slug)->first();
        if (is_null($category)){
          return view('errors.404');
        }
        $post = Post::where('status','=','PUBLISHED')->where('category_id','=',$category->id)->orderBy('created_at','desc')->paginate(10);
        $popular = Post::where('status','=','PUBLISHED')->where('category_id','=',$category->id)->orderBy('views','desc')->get()->take(4);
        $firstpopular = $popular[0];
        $listpopular = array();
        for($i=0;$i<3;$i++){
          if(!is_null($popular[$i+1])){
            $listpopular[$i] = $popular[$i+1];
          }
        }
        return view('list-category',[
          'post' => $post,
          'slug' => $slug,
          'firstpopular' => $firstpopular,
          'listpopular' => $listpopular
        ]);
    }
}

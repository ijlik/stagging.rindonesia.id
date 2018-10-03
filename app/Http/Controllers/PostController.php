<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $popular = Post::where('status','=','PUBLISHED')->where('category_id','!=',9)->inRandomOrder()->get()->take(4);
        $post = Post::where('status','=','PUBLISHED')->orderBy('created_at','desc')->where('category_id','!=',9)->paginate(9);
        return view('list-post', [
          'post' => $post,
          'popular' => $popular
        ]);
    }
  
    public function cari(Request $request){
        $query = $request->keywords;
        $hasil = Post::where('title', 'LIKE', '%' . $query . '%')->orWhere('body', 'LIKE', '%' . $query . '%')->orWhere('hastag', 'LIKE', '%' . $query . '%')->orderBy('created_at','desc')->get()->take(4);
        $text = null;
        foreach($hasil as $ini){
          $text .= '<a href="/posts/'.$ini->slug.'" class="list-group-item list-group-item-action flex-column align-items-start">
                      <div class="d-flex w-100 justify-content-between">
                        <h4 class="mb-1">'.$ini->title.'</h4>
                        <small class="text-muted">'.$ini->created_at.'</small>
                      </div>
                      <p class="mb-1">'.$ini->excerpt.'</p>
                    </a>';
        }
        return '<div class="list-group">'.$text.'</div>';
    }
  
    public function searchindex(Request $request){
        $query = $request->get('keywords');
        if (is_null($query)){
          return view('errors.404');
        } else {
          return redirect('/search/'.$query);
        }
      }
  
    public function search($keywords){
        $query = $keywords;
        $hasil = Post::where('title', 'LIKE', '%' . $query . '%')->orWhere('body', 'LIKE', '%' . $query . '%')->orWhere('hastag', 'LIKE', '%' . $query . '%')->orderBy('created_at','desc')->paginate(10);        
        
        return view('list-search',[
          'hasil' => $hasil,
          'katakunci' => $query
        ]);
    }
  
    public function show($slug){
        $popular = Post::where('status','=','PUBLISHED')->where('category_id','!=',9)->orderBy('views','desc')->get()->take(4);
        $news = Post::where('category_id','!=',9)->where('status','=','PUBLISHED')->orderBy('created_at','desc')->get()->take(4);
        $firstpopular = $popular[0];
        $listpopular = array();
        for($i=0;$i<3;$i++){
          $listpopular[$i] = $popular[$i+1];
        }
        $post = Post::where('slug','=',$slug)->first();
        if(is_null($post)){
          return view('errors.404');
        } else {
          if($post->status != 'PUBLISHED'){
            if(!Auth::user()){
              return view('errors.404');
            } else {
              if(Auth::user()->id != $post->author_id){
                return view('errors.404');
              }
            }
          } 
        }
        $mayalsolike = Post::where('category_id','!=',$post->category_id)->where('category_id','!=',9)->where('status','=','PUBLISHED')->inRandomOrder()->get()->take(3);;
        $moreincategory = Post::where('category_id','=',$post->category_id)->where('status','=','PUBLISHED')->where('id','!=',$post->id)->inRandomOrder()->get()->take(3);;
        
        $idawal = Post::where('status','=','PUBLISHED')->orderBy('created_at','asc')->first();
        $idakhir = Post::where('status','=','PUBLISHED')->orderBy('created_at','desc')->first();
        $postbefore = null;
        $postafter = null;
        if ($post->id > $idawal->id){
          $n = $post->id - 1;
          $postbefore = Post::where('id','=',$n)->where('status','=','PUBLISHED')->first();
          while(is_null($postbefore)){
            $n--;
            $postbefore = Post::where('id','=',$n)->where('status','=','PUBLISHED')->first();
          }
        } else {
          $postbefore = $idakhir;
        }
      
        if ($post->id < $idakhir->id){
          $m = $post->id + 1;
          $postafter = Post::where('id','=',$m)->where('status','=','PUBLISHED')->first();
          while(is_null($postafter)){
            $m++;
            $postafter = Post::where('id','=',$m)->where('status','=','PUBLISHED')->first();
          }
        } else {
          $postafter = $idawal;
        }
        
        
        $hastag = explode(',', $post->hastag);
        if(is_null($post)){
          return view('errors.404');
        } else {
          if($post->status == 'PUBLISHED'){
            $post->increment('views');
            $post->save();
          }
          return view('post',[
              'post' => $post,
              'hastag' => $hastag,
              'postbefore' => $postbefore,
              'postafter' => $postafter,
              'firstpopular' => $firstpopular,
              'listpopular' => $listpopular,
              'news' => $news,
              'mayalsolike' => $mayalsolike,
              'moreincategory' => $moreincategory
          ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Page;
use App\Inbox;
use App\Category;
use Mail;
use Log;

class HomeController extends Controller
{
    public function index(){
//        $cekCategory = Category::all();
//        foreach($cekCategory as $ini){
//            if(Post::isReady($ini->id) < 7){
//                return view('coming-soon');
//                break;
//            }
//        }
        $headline = Post::where('status','=','PUBLISHED')->where('category_id','!=',9)->where('featured','=',1)->orderBy('created_at','desc')->get()->take(11);
        $popular = Post::where('status','=','PUBLISHED')->where('category_id','!=',9)->orderBy('views','desc')->get()->take(3);
        $rlive = Post::where('status','=','PUBLISHED')->where('category_id','=',7)->orderBy('created_at','desc')->get()->take(7);
        $infografis = Post::where('status','=','PUBLISHED')->where('category_id','=',9)->orderBy('created_at','desc')->get()->take(4);
        $tokoh = Post::where('status','=','PUBLISHED')->where('category_id','=',4)->orderBy('created_at','desc')->get()->take(4);
        $news = Post::where('category_id','!=',9)->where('status','=','PUBLISHED')->orderBy('created_at','desc')->get()->take(6);
        $editorpick = Post::where('category_id','!=',9)->where('status','=','PUBLISHED')->where('editor_pick','=','1')->orderBy('created_at','desc')->get()->take(4);
        $random = Post::where('status','=','PUBLISHED')->where('category_id','!=',9)->inRandomOrder()->get()->take(10);
        $firstrand = $random[0];
        $secondrand = $random[1];
        $leftrand = array();
        $rightrand = array();
        $n = 0;
        $m = 0;
        for($i = 2; $i < 6; $i++){
          $leftrand[$n] = $random[$i];
          $n++;
        }
        for($i = 6; $i < 10; $i++){
          $rightrand[$m] = $random[$i];
          $m++;
        }
      
        return view('home',[
          'messages' => null,
          'headline' => $headline,
          'popular' => $popular,
          'rlive' => $rlive,
          'news' => $news,
          'infografis' => $infografis,
          'tokoh' => $tokoh,
          'firstrand' => $firstrand,
          'secondrand' => $secondrand,
          'leftrand' => $leftrand,
          'rightrand' => $rightrand,
          'editorpick' =>$editorpick
        ]);
    }
    public function show($slug){
        $post = Page::where('slug','=',$slug)->where('status','=','ACTIVE')->first();
        if(is_null($post)){
            return view('errors.404');
        } else {
            return view('page',[
                'post' => $post
            ]);
        }
    }
    public function contact(){
        return view('contact',[
            'status' => null
        ]);
    }
    public function send(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|min:10|max:255',
            'phone' => 'required|numeric|min:10',
            'subject' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'required|string|max:255',
        ]);

        $pesan = null;
        if($request->category == 'kritik'){
            $pesan = 'Terima kasih, masukan anda sangat membantu bagi kami.';
        } elseif ($request->category == 'lain'){
            $pesan = 'Terima kasih telah menghubungi kami.';
        } else {
            $pesan = 'Terima kasih, pesan anda telah kami terima. Kami akan segera menghubungi anda melalui email atau nomor hp yang telah anda cantumkan.';
        }

        $insert = new Inbox();
        $insert->name = $request->name;
        $insert->email = $request->email;
        $insert->phone = $request->phone;
        $insert->subject = $request->subject;
        $insert->category = $request->category;
        $insert->body = $request->body;
        $insert->status = 'baru';
        $insert->notes = '';
        $insert->save();

        if(env('MAIL_USERNAME') != null && env('MAIL_USERNAME') != "null" && env('MAIL_USERNAME') != "") {
            // Send mail to admin
            Mail::send('email.pesan-masuk', ['nama' => $request->name, 'email' => $request->email, 'subject' => $request->subject, 'category' => $request->category, 'body' => $request->body ], function ($m) {
                $m->from('no-reply@rindonesia.id', 'Dari Website R Indonesia');
                $m->to('redaksirumahindonesia@gmail.com', 'R Indonesia')->subject('Ada Pesan Baru dari Netizen yang budiman');
            });

            Log::info("Pesan terkirim. dari ".$request->nama." email: ".$request->email);
        } else {
            Log::info("Gagal dikirim. dari ".$request->nama." email: ".$request->email);
        }

        return view('contact',[
            'status' => 'success',
            'messages' => $pesan
        ]);
    }
}

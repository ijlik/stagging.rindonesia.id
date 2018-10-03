<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use Log;

class UserController extends Controller
{
    public function index(){
        $popular = Post::where('status','=','PUBLISHED')->where('category_id','!=',9)->inRandomOrder()->get()->take(4);
        $post = Post::orderBy('created_at','desc')->where('category_id','!=',9)->paginate(9);
        return view('list-post', [
          'post' => $post,
          'popular' => $popular
        ]);
    }
  
    public function author(){
      $author = User::where('role_id','=','3')->orWhere('role_id','=','4')->get();
      $jumlah_post = array();
      $index = 0;
      foreach($author as $penulis){
        $jumlah_post[$index] = Post::where('author_id','=',$penulis->id)->where('status','=','PUBLISHED')->get()->count();
        $index++;
      }
      for($i=1; $i < count($jumlah_post) ; $i++){
          for($j = count($jumlah_post)-1 ; $j>=$i; $j--){
            if($jumlah_post[$j] > $jumlah_post[$j-1]){
              $temp 		= $jumlah_post[$j];
              $temp2    = $author[$j];
              $jumlah_post[$j] 	= $jumlah_post[$j-1];
              $author[$j] = $author[$j-1];
              $jumlah_post[$j-1] = $temp;
              $author[$j-1] = $temp2;
            }
          }
        }
      $m = 0;
      foreach($author as $penulis){
        $jumlah[$m] = Post::where('author_id','=',$penulis->id)->get()->count();
        $m++;
      }
      $random = Post::where('status','=','PUBLISHED')->where('category_id','!=',9)->inRandomOrder()->get()->take(5);
      $rightrand = array();
      $secondrand = $random[0];
      $n = 0;
      for($i = 1; $i < 5; $i++){
          $rightrand[$n] = $random[$i];
          $n++;
        }
      return view('list-author',[
        'author' => $author,
        'jumlah_post' => $jumlah_post,
        'jumlah' => $jumlah,
        'secondrand' => $secondrand,
        'rightrand' => $rightrand,
      ]);
    }
  
  public function authorShow($id){
      $author = User::find($id);
      if(is_null($author) || $author->role_id == 1 || $author->role_id == 5){
        return view('errors.404');
      }
      if(Auth::user() && Auth::user()->id == $author->id){
        $post = Post::where('author_id','=',$author->id)->orderBy('created_at', 'desc')->paginate(10);
      } else {
        $post = Post::where('author_id','=',$author->id)->where('status','=','PUBLISHED')->orderBy('created_at', 'desc')->paginate(10);
      }
      $jumlah_post = Post::where('author_id','=',$author->id)->where('status','=','PUBLISHED')->get()->count();
      $jumlah = Post::where('author_id','=',$author->id)->get()->count();
      return view('author',[
        'author' => $author,
        'post' => $post,
        'jumlah_post' => $jumlah_post,
        'jumlah' => $jumlah
      ]);
    }
  
    public function register(Request $request){
      $rule = [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'g-recaptcha-response' => 'required'
      ];
      $validator = Validator::make($request->all(), $rule);
      if ($validator->fails()) {
				return '<script> alert("Maaf, '.$validator->errors()->first().'"); window.location = "/";</script>';
			}
      
      $secret_key = '6LfDtXEUAAAAANV0hVanPrT7lweEvVitTK4hW8Rq';
      $captcha = $_POST['g-recaptcha-response'];
      $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
      $recaptcha = file_get_contents($url);
      $recaptcha = json_decode($recaptcha, true);
      if (!$recaptcha['success']){
        return '<script> alert("Waduh!, Error. Captcha tidak valid"); window.location = "/";</script>';
      }
      
      $password= str_random(8);
      
      $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password),
            'role_id' => '4',
            'avatar' => 'users/default.png',
            'settings' => '{"locale":"id"}'
      ]);
      
      if(env('MAIL_USERNAME') != null && env('MAIL_USERNAME') != "null" && env('MAIL_USERNAME') != "") {
				// Send mail to User his Password
				Mail::send('email.akun', ['user' => $user, 'password' => $password], function ($m) use ($user) {
					$m->from('no-reply@rindonesia.id', 'Admin Redaksi - R Indonesia');
					$m->to($user->email, $user->name)->subject('Informasi Akun Donatur Berita R Indonesia');
				});
				
				Log::info("Informasi akun terkirim. User created: username: ".$user->email." Password: ".$password);
			} else {
				Log::info("Gagal dikirim. User created: username: ".$user->email." Password: ".$password);
			}
      
      return '<script> alert("Sukses!, Silahkan cek email anda untuk informasi lebih lanjut"); window.location = "/";</script>';
    }
  //------------------------------------------------------------------------------------------------------------------------------------------------------
    public function forgot(Request $request){
      $rule = [
          'email' => 'required|string|email|max:255',
          'g-recaptcha-response' => 'required'
      ];
      $validator = Validator::make($request->all(), $rule);
      if ($validator->fails()) {
        $error = null;
        foreach ($validator as $err){
          $error .= $err;
        }
				return '<script> alert("Error !!!. '.$error.'"); window.location = "/";</script>';
			}
      
      $secret_key = '6LfDtXEUAAAAANV0hVanPrT7lweEvVitTK4hW8Rq';
      $captcha = $_POST['g-recaptcha-response'];
      $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
      $recaptcha = file_get_contents($url);
      $recaptcha = json_decode($recaptcha, true);
      if (!$recaptcha['success']){
        return '<script> alert("Waduh!, Error. Captcha tidak valid"); window.location = "/";</script>';
      }
      
      $password= str_random(8);
      
      $user = User::where('email','=',$request->email)->first();
      if (is_null($user)){
        return '<script> alert("Maaf!, Email anda belum terdaftar. Silahkan mendaftarkan terlebih dahulu"); window.location = "/";</script>';
      } else {
        $user->password = bcrypt($password);
        $user->save();
        
        if(env('MAIL_USERNAME') != null && env('MAIL_USERNAME') != "null" && env('MAIL_USERNAME') != "") {
          // Send mail to User his Password
          Mail::send('email.forgot', ['user' => $user, 'password' => $password], function ($m) use ($user) {
            $m->from('no-reply@rindonesia.id', 'Admin Redaksi - R Indonesia');
            $m->to($user->email, $user->name)->subject('Perubahan Informasi Akun Donatur Berita R Indonesia');
          });

          Log::info("Informasi akun terkirim. User created: username: ".$user->email." Password: ".$password);
        } else {
          Log::info("Gagal dikirim. User created: username: ".$user->email." Password: ".$password);
        }

        return '<script> alert("Sukses!, Informasi akun anda sudah kami kirimkan melalui email"); window.location = "/";</script>';
      }
    }
}

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

class GuestController extends Controller
{

    public function profile(Request $request, $id){
      $author = User::find($id);
      if(Auth::user()->id != $author->id){
        return view('errors.404');
      }
      
      return view('edit-profile',[
        'author' => $author
      ]);
    }
  
    public function tulisanForm(){
      if(!Auth::user()){
        return view('errors.404');
      }
      if(Auth::user()->role_id == 4){
        return view('create-post');  
      } else {
        return view('errors.404');
      }
    }
}

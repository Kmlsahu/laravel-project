<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function index()
   {
      return view("admin.login.index"); 
   }
   public function loginPost(Request $request)
   {

      $loginData = $request->only("email", "password");

      if (Auth::attempt($loginData)) {
         return redirect()->route('dashboard');
      } else {
         return redirect()->route('login')->withError("message", "Credentilas not correct");
      }
   }
   public function signOut(Request $request)
   {
      Auth::logout();
      return redirect()->route('login');
   }
}

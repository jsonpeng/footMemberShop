<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\User;

class PintuanController extends Controller
{
    //

    public function index(){
        $products=products::all();
        $user_join=User::all();
        return view('pintuan.index')->with('products',$products)->with('user_join',$user_join);

    }
}

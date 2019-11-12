<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $user = User::find(Auth::id());

        return view('pages.main')
            ->with('user',$user);

    }

    public function category(){

        $user = User::find(Auth::id());

        $categories = Category::all();

        return view('pages.category.main')
            ->with('categories',$categories)
            ->with('user',$user);

    }

}

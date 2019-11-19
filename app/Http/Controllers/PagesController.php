<?php

namespace App\Http\Controllers;

use App\Category;
use App\Templates;
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
        $templates = Templates::all();

        return view('pages.category.main')
            ->with('categories',$categories)
            ->with('user',$user);

    }

    public function templates(){

        $user = User::find(Auth::id());

        $templates = Templates::all();

        return view('pages.templates.main')
            ->with('user',$user)
            ->with('templates',$templates);

    }

    public function cards(Request $request){

        $user = User::find(Auth::id());


        return view('pages.cards.main')
            ->with('user',$user);

    }

}

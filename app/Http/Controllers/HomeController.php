<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    //
    public function home()
    {
        $data =  [
            'post' => Post::limit(5)->get(), 
            'total' => Post::count(),
            'carousel_items' => Post::limit(3)->get(),
        ];
        return view('public.index', $data);
    }
}

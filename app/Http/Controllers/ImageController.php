<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Image;

class ImageController extends Controller
{
    //
    public function upload (Request $request) {
        $username = Auth::user()->name;
        $date = Carbon::now()->toDateString();
        $path = $request->file('image')->store('image/'.$username.'/'.$date);
        $name = $request->file('image')->hashName();
        $image = Image::create([
            'name' => $name,
            'url' => asset($path),
        ]);
        return ['id' => $image->id, 'url' => $image->url];
    }
}

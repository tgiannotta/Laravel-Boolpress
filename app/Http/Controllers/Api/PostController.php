<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;


class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(9);

        $response_array = [
            'success' =>true,
            'results' =>$posts
        ];

        return response()->json($response_array);
    }
    public function show($slug){
            $post = Post::where('slug', '=', $slug)->with (['category', 'tags'])->first();
            
            return response()->json([
                'success' => true,
                'results' => $post
                
            ]);
    }
}

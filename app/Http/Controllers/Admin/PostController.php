<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];
        
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];
        
        
        
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        
        $request->validate($this->getValidationRules());

        $new_post = new Post();
        $new_post->fill($form_data);

       
        $new_post->slug = $this->getUniqueSlugFromTitle($form_data['title']);
       
        $new_post->save();
        if(isset($form_data['tags'])){
            $new_post->tags()->sync($form_data['tags']);

        }

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        

        $data =[
             'post' => $post
        ];
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $data = [
            'post' => $post,
            'categories' => $categories
        ];
        
        
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form_data = $request->all();
        $request->validate($this->getValidationRules());

        $post = Post::findOrFail($id);

        
        if($form_data['title'] != $post->title){
            $form_data['slug'] = $this->getUniqueSlugFromTitle($form_data['title']);
            
        }
        $post->update($form_data);

        return redirect()->route('admin.posts.show', ['post' =>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
    protected function getValidationRules(){
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000'
        ];
    }
    protected function getUniqueSlugFromTitle($title){
        $slug = str::slug($title);
        $slug_base = $slug;
        $post_found = Post::where('slug', '=', $slug)->first();
        $counter =1;
        while($post_found){
            $slug = $slug_base . '-' . $counter;
            $post_found = Post::where('slug', '=', $slug)->first();
            $counter++;

        }
        return $slug;
    }
}

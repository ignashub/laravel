<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Event;
use View;
use DB;
use PDF;

class PostController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'create']]);
    }

    public function index()
    {
        // $posts = Post::all();
        // ordering by title and having pagination:
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-post')) {
            // The current user can't create a post...
            return redirect()->back()->with('error', 'You must be logged-in to create posts');
        }
        else{
            return view('posts.create');
            // The current user can create a post...
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'recipe_image' => 'image|nullable|max:5000'
        ]);

        //Handling file upload
        if($request->hasFile('recipe_image')){

            $imageName = '_image'.time().'.'.request()->recipe_image->getClientOriginalExtension();

            $directory = public_path('/storage/recipe_images/');
            $pixelDirectory = public_path('/storage/recipe_images/pixelated/');
            $imageUrl = $directory.$imageName;
            $pixelUrl = $pixelDirectory.$imageName;
            Image::make($request->recipe_image)->fit(250, 250)->insert(public_path('/images/watermark/watermark.png'))->save($imageUrl);
            Image::make($request->recipe_image)->fit(250, 250)->pixelate(8)->insert(public_path('/images/watermark/watermark.png'))->save($pixelUrl);
        } else {
            $imageName = 'noimage.jpg';
        }
        if (Gate::denies('create-post')) {
            // The current user can't create a post...
            return redirect()->back()->with('error', 'You must be logged-in to create posts');
        }
        else{
            // Create Post
            $post = new Post;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->recipe_image = $imageName;
            $post->save();

            return redirect('/posts')->with('success', 'Post Created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);
        //check for correct user

        if (Gate::denies('update-post', $post)) {
            // The current user can't update the post...
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        else{
            // The current user can update the post...
            return view('posts.edit')->with('post', $post);
        }
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

          //Handling file upload
          if($request->hasFile('recipe_image')){
            // Get filename with the extension

              $imageName = '_image'.time().'.'.request()->recipe_image->getClientOriginalExtension();

              $directory = public_path('/storage/recipe_images/');
              $pixelDirectory = public_path('/storage/recipe_images/pixelated/');
              $imageUrl = $directory.$imageName;
              $pixelUrl = $pixelDirectory.$imageName;
              Image::make($request->recipe_image)->fit(250, 250)->insert(public_path('/images/watermark/watermark.png'))->save($imageUrl);
              Image::make($request->recipe_image)->fit(250, 250)->pixelate(8)->insert(public_path('/images/watermark/watermark.png'))->save($pixelUrl);
        }
          else{
              $imageName = 'noimage.jpg';
          }

        // Create Post
        $post = Post::find($id);

        if (Gate::denies('update-post', $post)) {
            // The current user can't update the post...
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        else {
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            if ($request->hasFile('recipe_image')) {
                if ($post->recipe_image != 'noimage.jpg') {
                    Storage::delete('public/recipe_images/'.$post->recipe_image);
                }
                $post->recipe_image = $imageName;
            }
            $post->save();

            return redirect('/posts')->with('success', 'Post Updated');
        }
    }

    public function update_post_pic(Request $request, $id){

        $request->validate([
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        $post = Post::find($id);

        $imageName = $post->id.'_image'.time().'.'.request()->image->getClientOriginalExtension();

        $directory = public_path('public/storage/posts');
        $pixelDirectory = public_path('public/storage/pixelated_posts/');

        $imageUrl = $directory.$imageName;
        $pixelUrl = $pixelDirectory.$imageName;

        Image::make($request->avatar)->fit(250, 250)->insert(public_path('public/storage/watermark/watermark.png'))->save($imageUrl);
        Image::make($request->avatar)->fit(250, 250)->pixelate(12)->insert(public_path('public/storage/watermark/watermark.png'))->save($pixelUrl);

        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Finding a post by its ID being passed in
        $post = Post::find($id);

        if (Gate::denies('update-post', $post)) {
            // The current user can't update the post...
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        else{
            if($post->recipe_image != 'noimage.jpg'){
                // Delete Image
                Storage::delete('public/recipe_images/'.$post->recipe_image);
            }

            $post->delete();
            return redirect('/posts')->with('success', 'Post Removed');
        }
    }

    public function generate_pdf($id){
        $post = Post::find($id);
        $pdf = \App::make('dompdf.wrapper');
        $view = (string)View::make('posts.pdf')->with('post', $post);
        $pdf->loadHTML($view);
        return $pdf->stream();
    }
}

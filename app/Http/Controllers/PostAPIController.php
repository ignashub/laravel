<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostAPIController extends Controller
{
    public function getAllPosts() {
        // logic to get all posts goes here
        return response()->json(Post::get(), 200);
    }

    public function createPost(Request $request) {
        // logic to create a post record goes here
        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    public function getPost($id) {
        // logic to get a post record goes here
        if(Post::where('id', $id)->exists()){
            $post = Post::find($id);
            return $post;
        } else {
            return response()->json([
                "message" => "Post not found"
            ], 404);
        }
    }

    public function updatePost(Request $request, $id) {
        // logic to update a post record goes here
        if(Post::where('id', $id)->exists()){
            $post = User::find($id);
            $post->update($request->all());

            return response()->json($post, 200);
        }else {
            return response()->json([
                "message" => "Post not found"
            ], 404);
        }
    }

    public function deletePost ($id) {
        // logic to delete a post record goes here
        if(Post::where('id', $id)->exists()){
            $post = Post::find($id);
            $post->delete();

            return response()->json(null, 204);
        }else {
            return response()->json([
                "message" => "Post not found"
            ], 404);
        }
    }
}

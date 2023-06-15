<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // get all posts
    public function getAllPosts(Request $request){
        $posts = Post::all();
        return response()->json([
            "posts"=>$posts
        ]);
    }

    // get one post by id
    public function getPost($id) {
        $post = Post::find($id);
        return response()->json([
            "post" => $post
        ]);
    }

    // Create post with circle_id, user_id (auth user), type_id and content
    public function createPost(Request $request){
        // If the fields are not filled, return an error with a message
        if($request->circle_id == null || $request->type == null || $request->post_content == null){
            return response()->json([
                "message"=>"Por favor rellena todos los campos: circle_id, type_id and content"
            ], 400);
        }

        $post = Post::create([
            "post_content"=>$request->post_content,
            "type"=>$request->type,
            "user_id"=>auth()->user()->id,
            "circle_id"=>$request->circle_id
        ]);
        return response()->json([
            "post"=>$post
        ]);
    }

    // function to receive a image from the body and save it in the public folder
    public function uploadImage(Request $request){
        // if there is no image in the request, return an error
        if(!$request->hasFile('image')){
            return response()->json([
                "message"=>"No se ha encontrado ninguna imagen"
            ], 400);
        }

        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);

        // create a new post with path of the image in the post_content
        $post = Post::create([
            "post_content"=>"/images/".$imageName,
            "type"=>2,
            "user_id"=>auth()->user()->id,
            "circle_id"=>$request->circle_id
        ]);

        return response()->json([
            "post"=>$post
        ]);
    }

    // delete post by id
    public function deletePost($id){
        // set that only the creator of the post can delete it
        $post = Post::find($id);
        if(auth()->user()->id != $post->user_id){
            return response()->json([
                "message"=>"No puedes borrar un post que no es tuyo"
            ], 400);
        }

        $post->delete();
        return response()->json([
            "message"=>"Post borrado correctamente"
        ]);

    }

    // get all posts from a circle
    public function getPostsByCircle($id){
        $posts = Post::with('user')->where('circle_id', $id)->get();
        return response()->json([
            "posts"=>$posts
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PostMedia;
use App\Models\PostTag;

class PostController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
   //
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
   //
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $validate = $this->validate($request, [
         'title' => 'required|string|min:5|max:255',
         'post_category_id' => 'required',
         'content' => 'required|string|min:5',
         'cover_image' => 'required|image|mimes:png,jpg,jpeg|max:2000',
         'post_media.*' => 'mimes:png,jpg,jpeg,avi,mpeg,quicktime,mp4|max:10240',
         'tag_id' => 'required',
      ]);

      $validate['user_created'] = Auth::id();
      $validate['admin_validated'] = null;
      $validate['status'] = 0;
      $post = Post::create($validate);

      $file = $request->cover_image;
      $fileType = $file->getClientOriginalExtension();
      $fileName = 'cover.' . $fileType;
      $filePath = 'public/social/' . $post->id . '/' . $fileName;
      Storage::put($filePath, file_get_contents($file));
      $validate['cover_image'] = Storage::url($filePath);
      $post->update($validate);

      if ($request->hasFile('post_media')) {
         foreach ($request->post_media as $file) {
            $mime = $file->getClientmimeType();

            if (strstr($mime, 'video/')) {
               $postmedia = PostMedia::create(['post_id' => $post->id, 'type' => 'video', 'path' => 'temporary', 'status' => 0]);
               $fileType = $file->getClientOriginalExtension();
               $fileName = $postmedia->id . '.' . $fileType;
               $filePath = 'public/social/' . $post->id . '/' . $fileName;
               Storage::put($filePath, file_get_contents($file));
               $validate['path'] = Storage::url($filePath);
               $postmedia->update($validate);
            }
            else if (strstr($mime, 'image/')) {
               $postmedia = PostMedia::create(['post_id' => $post->id, 'type' => 'image', 'path' => 'temporary', 'status' => 0]);
               $fileType = $file->getClientOriginalExtension();
               $fileName = $postmedia->id . '.' . $fileType;
               $filePath = 'public/social/' . $post->id . '/' . $fileName;
               Storage::put($filePath, file_get_contents($file));
               $validate['path'] = Storage::url($filePath);
               $postmedia->update($validate);
            }
         }
      }

      foreach ($request->tag_id as $item) {
         PostTag::create(['tag_id' => $item, 'post_id' => $post->id]);
      }

      return back()->with('success', 'Post berhasil dibuat');
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function show(Post $post)
   {
   //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function edit(Post $post)
   {
   //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Post $post)
   {
   //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function destroy(Post $post)
   {
   //
   }
}
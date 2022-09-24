<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use App\Models\Pramuka;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostMedia;

class SocialController extends Controller
{
   public function userFeed($anggota_id)
   {
      $anggota = Anggota::find($anggota_id);
      $user = $anggota->user;
      $kategori = PostCategory::all();
      $tags = Tag::all();
      return view('social.user.feed', compact('user', 'anggota', 'kategori', 'tags'));
   }

   public function userGallery($anggota_id)
   {
      $anggota = Anggota::find($anggota_id);
      $user = $anggota->user;
      return view('social.user.gallery', compact('user', 'anggota'));
   }

   public function userFriend($anggota_id)
   {
      $anggota = Anggota::find($anggota_id);
      $user = $anggota->user;
      return view('social.user.friend', compact('user', 'anggota'));
   }

   public function userSertification($anggota_id)
   {
      $anggota = Anggota::find($anggota_id);
      $user = $anggota->user;
      $pramuka = Pramuka::where('id', '!=', 5)->select('name', 'id')->get();
      $data = Document::all()->where('user_id', Auth::id())->groupBy('pramuka');
      return view('social.user.sertification', compact('user', 'anggota', 'pramuka', 'data'));
   }

   public function news()
   {
      return view('social.blog');
   }

   public function event()
   {
      return view('social.event');
   }

   public function photo()
   {
      return view('social.photo');
   }

   public function video()
   {
      return view('social.video');
   }

   public function shop()
   {
      return view('social.shop');
   }

   public function announcement()
   {
      return view('social.announcement');
   }

   public function profile()
   {
      $user = Auth::user();
      $anggota = $user->anggota;
      $provinsi = Provinsi::pluck('name', 'id');
      return view('social.profile', compact('anggota', 'user', 'provinsi'));
   }

   public function storePost(Request $request)
   {
      $validate = $this->validate($request, [
         'title' => 'required|string|max:255',
         'post_category_id' => ['required', Rule::in(['1', '2', '3', '4', '5', '6', '7', '8', '9'])],
         'content' => 'required|string|min:3',
         'cover_image' => 'required|image|mimes:png,jpg,jpeg|max:1024',
      ]);

      $validate['user_created'] = Auth::id();
      $validate['admin_validated'] = 1;
      $validate['status'] = 0;
      $post = Post::create($validate);

      $file = $request->cover_image;
      $fileType = $file->getClientOriginalExtension();
      $fileName = $post->id . '.' . $fileType;
      $filePath = 'public/social/' . $fileName;
      Storage::put($filePath, file_get_contents($file));
      $validate['cover_image'] = Storage::url($filePath);
      $post->update($validate);

      if ($request->hasFile('post_media')) {
         foreach ($request->post_media as $file) {
            // $mime = mime_content_type(file_get_contents($file));
            $mime = $file->getClientmimeType();
            if (strstr($mime, 'video/')) {
            // $postmedia = PostMedia::create(['type' => 'video', 'status' => 0]);

            // $fileType = $file->getClientOriginalExtension();
            // $fileName = $postmedia->id . '.' . $fileType;
            // $filePath = 'public/social/' . $fileName;
            // Storage::put($filePath, file_get_contents($file));

            // $validate['path'] = Storage::url($filePath);
            // $post->update($validate);
            }
            else if (strstr($mime, 'image/')) {
               // $postmedia = PostMedia::create(['type' => 'image', 'status' => 0]);

               // $fileType = $file->getClientOriginalExtension();
               // $fileName = $postmedia->id . '.' . $fileType;
               // $filePath = 'public/social/' . $fileName;
               // Storage::put($filePath, file_get_contents($file));

               // $validate['path'] = Storage::url($filePath);
               // $post->update($validate);


               $fileType = $file->getClientOriginalExtension();
               $fileName = time() . '.' . $fileType;
               $filePath = 'public/social/' . $fileName;
               Storage::put($filePath, file_get_contents($file));


               $postmedia = PostMedia::create(['post_id' => $post->id, 'type' => 'image', 'path' => Storage::url($filePath), 'status' => 0]);

            }
         }
      }


      return back()->with('success', 'Post berhasil dibuat');
   }

}
<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\PostMedia;

class PostMediaService extends Repository
{
    public function storeMedia($mediaFiles, $validate, $postId = null)
    {
        /* jika tidak ada postId maka dia galeri */

        foreach ($mediaFiles as $file) {
            $mime = $file->getClientmimeType();
            if (strstr($mime, 'video/')) {
                if ($postId) {
                    $postmedia = PostMedia::create(['post_id' => $postId, 'user_id' => Auth::id(), 'type' => 'video', 'path' => 'temporary', 'status' => 0]);
                } else {
                    $postmedia = PostMedia::create(['user_id' => Auth::id(), 'type' => 'video', 'path' => 'temporary', 'status' => 0]);
                }
                $fileType = $file->getClientOriginalExtension();
                $fileName = $postmedia->id . '.' . $fileType;
                if ($postId) {
                    $filePath = 'public/social/media/' . Auth::id() . '/' . $postId . '/' . $fileName;
                } else {
                    $filePath = 'public/social/media/' . Auth::id() . '/' . $fileName;
                }

                Storage::put($filePath, file_get_contents($file));
                $validate['path'] = Storage::url($filePath);
                $postmedia->update($validate);
            } else if (strstr($mime, 'image/')) {
                if ($postId) {
                    $postmedia = PostMedia::create(['post_id' => $postId, 'user_id' => Auth::id(), 'type' => 'image', 'path' => 'temporary', 'status' => 0]);
                } else {
                    $postmedia = PostMedia::create(['user_id' => Auth::id(), 'type' => 'image', 'path' => 'temporary', 'status' => 0]);
                }
                $fileType = $file->getClientOriginalExtension();
                $fileName = $postmedia->id . '.' . $fileType;
                if ($postId) {
                    $filePath = 'public/social/media/' . Auth::id() . '/' . $postId . '/' . $fileName;
                } else {
                    $filePath = 'public/social/media/' . Auth::id() . '/' . $fileName;
                }

                Storage::put($filePath, file_get_contents($file));
                $validate['path'] = Storage::url($filePath);
                $postmedia->update($validate);
            }
        }
    }
}
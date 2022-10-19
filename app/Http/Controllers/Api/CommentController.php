<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id ?? null,
            'story_id' => $request->story_id ?? null,
            'agenda_id' => $request->agenda_id ?? null,
            'comment' => $request->comment,
        ]);

        $html = '<li class="main-comments">
        <div class="each-comment">
            <div class="post-header">
                <div class="media">
                    <div class="user-img">
                        <img src="'. asset('berkas/anggota/'. $comment->user->anggota->foto) .'" alt="'.$comment->user->name.'" style="width:40px;height:40px;">
                    </div>
                    <div class="media-body">
                        <div class="user-title"><a href="#">'. $comment->user->name .'</a></div>
                        <ul class="entry-meta">
                            <li class="meta-privacy"><i class="icofont-world"></i>Public</li>
                            <li class="meta-time">'. Carbon::parse($comment->created_at)->diffForHumans() .'</li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Close</a>
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="post-body">
                <p>'. $comment->comment .'</p>
            </div>
        </div>
    </li>';

        return response(['status'=>'success','data'=>$comment, 'html'=>$html]);
    }
}

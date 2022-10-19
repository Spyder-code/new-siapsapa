<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReactPost;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    public function store(Request $request)
    {
        $react = ReactPost::where('user_id',$request->user_id)->where('react_id',$request->react_id)->first();
        if(!$react){
            $react = ReactPost::create([
                'user_id' => $request->user_id,
                'post_id' => $request->post_id ?? null,
                'story_id' => $request->story_id ?? null,
                'agenda_id' => $request->agenda_id ?? null,
                'react_id' => $request->react_id,
            ]);
        }

        $reacts = ReactPost::all()->where('story_id',$request->story_id)->groupBy('react_id');
        $html = '';
        foreach ($reacts as $item ) {
            $html = $html.'<div class="post-reaction">
            <div class="reaction-icon">
                <img src="'. asset($item->first()->react->path) .'" alt="'. $item->first()->name .'">
                <sup class="count-react">'. $item->count() .'</sup>
            </div>
        </div>';
        };

        return response(['status'=>'success','data'=>$react, 'html'=> $html]);
    }
}

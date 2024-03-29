<?php

namespace App\Http\Controllers;

use App\Models\PostMedia;
use App\Repositories\PostMediaService;
use Illuminate\Http\Request;

class PostMediaController extends Controller
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
        try {
            $validate = $this->validate($request, [
                'post_media.*' => 'mimes:png,jpg,jpeg,mpeg,quicktime,mp4|max:30000',
            ]);
            $service = new PostMediaService();
            $service->storeMedia($request->post_media, $validate);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function show(PostMedia $postMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(PostMedia $postMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostMedia $postMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostMedia $postMedia)
    {
        //
    }
}
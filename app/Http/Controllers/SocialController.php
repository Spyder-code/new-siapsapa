<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use App\Models\Pramuka;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Auth;
use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\Agenda;
use App\Models\Kegiatan;
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
        $post = Post::all();
        return view('social.user.feed', compact('user', 'anggota', 'kategori', 'tags', 'post'));
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
        // $data = Document::all()->where('user_id', Auth::id())->groupBy('pramuka');
        $data = Document::where('user_id', $user->id)->get();
        return view('social.user.sertification', compact('user', 'anggota', 'pramuka', 'data'));
    }

    public function news()
    {
        $postCategory = PostCategory::all();
        $post = Post::select('posts.*', 'post_categories.name')->join('post_categories', 'post_categories.id', '=', 'posts.post_category_id')->get();
        return view('social.blog', compact('postCategory', 'post'));
    }

    public function newsDetail($id)
    {
        $post =  Post::select('posts.*', 'post_categories.name as kategori', 'users.name as nama_user')
            ->join('post_categories', 'post_categories.id', '=', 'posts.post_category_id')
            ->join('users', 'users.id', '=', 'posts.user_created')->find($id);
        $postMedia = PostMedia::where('post_id', '=', $id)->get();
        return view('social.single-blog', compact('post', 'postMedia'));
    }

    public function event()
    {
        $agenda = Agenda::all();
        foreach ($agenda as $item) {
            $time = strtotime($item->tanggal_selesai);
            $now = strtotime(date('Y-m-d'));
            if ($time > $now) {
                $item->is_finish = 0;
            } else {
                $item->is_finish = 1;
            }
            $item->save();
        }
        return view('social.event', compact('agenda'));
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

    public function agendaDetail($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $agenda = Agenda::find($id);
        $kegiatan = Kegiatan::where('agenda_id', $agenda->id)->orderBy('jam', 'asc')->get();
        return view('social.event-detail', compact('agenda', 'kegiatan'));
    }
}
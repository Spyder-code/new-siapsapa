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
use App\Models\Cart;
use App\Models\Follower;
use App\Models\Kegiatan;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\Product;
use App\Models\Reacts;
use App\Models\Story;
use App\Models\TransactionDetail;
use Illuminate\Support\Carbon;

class SocialController extends Controller
{
    public function userFeed($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        $kategori = PostCategory::all();
        $tags = Tag::all();
        $post = Post::orderByDesc('id')->get();
        return view('social.user.feed', compact('user', 'anggota', 'kategori', 'tags', 'post'));
    }

    public function home()
    {
        $kategori = PostCategory::all();
        $tags = Tag::all();
        $post = Post::paginate(3);
        $stories = Story::where('status',1)
                    ->whereDate('start_date','>=', date('Y-m-d'))
                    ->whereDate('end_date','<=', date('Y-m-d',strtotime("+1 days")))
                    ->orderBy('created_at','desc')
                    ->get();
        $reacts = Reacts::all();
        if (request()->ajax()) {
    		$view = view('data.feedList',compact('post'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('social.home', compact('kategori', 'tags', 'post','stories','reacts'));
    }

    public function userGallery($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        $postMedia = PostMedia::where('user_id', '=', $user->id)->orderByDesc('id')->get();
        return view('social.user.gallery', compact('user', 'anggota', 'postMedia'));
    }

    public function userFriend($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        $follower = Follower::where('following', '=', $user->id)->orderByDesc('id')->get();
        $following = Follower::where('user_id', '=', $user->id)->orderByDesc('id')->get();
        return view('social.user.friend', compact('user', 'anggota', 'follower', 'following'));
    }

    public function userSertification($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        $pramuka = Pramuka::where('id', '!=', 5)->select('name', 'id')->get();
        // $data = Document::all()->where('user_id', Auth::id())->groupBy('pramuka');
        $data = Document::where('user_id', $user->id)->orderByDesc('id')->get();
        return view('social.user.sertification', compact('user', 'anggota', 'pramuka', 'data'));
    }

    public function news()
    {
        $postCategory = PostCategory::all();
        if(request('category')){
            $post = Post::where('post_category_id',request('category'))->paginate(6);
        }else{
            $post = Post::select('posts.*', 'post_categories.name')->join('post_categories', 'post_categories.id', '=', 'posts.post_category_id')->paginate(6);
        }

        $category = request('category');

        if (request()->ajax()) {
    		$view = view('data.postList',compact('post'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('social.blog', compact('postCategory', 'post','category'));
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
        $files = PostMedia::where('type','image')->paginate(8);
        if (request()->ajax()) {
    		$view = view('data.photoList',compact('files'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('social.photo', compact('files'));
    }

    public function video()
    {
        $files = PostMedia::where('type','video')->paginate(8);
        if (request()->ajax()) {
    		$view = view('data.videoList',compact('files'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('social.video', compact('files'));
    }

    public function shop()
    {
        $products = Product::all();
        return view('social.shop', compact('products'));
    }

    public function shopDetail($id = 1)
    {
        $product = Product::findOrFail($id);
        return view('social.shop-detail', compact('product'));
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

    public function cart()
    {
        $carts = Cart::where('user_id', Auth::id())->with('anggota')->get();
        $pramuka = Pramuka::all();
        return view('social.cart', compact('carts','pramuka'));
    }

    public function createTransaction()
    {
        $total = Cart::all()->where('user_id', Auth::id())->sum('harga');
        return view('social.transaction.create', compact('total'));
    }

    public function transaction()
    {
        $status = 'all';
        $query = TransactionDetail::query();
        if(request()->has('status')){
            $query->where('status',request('status'));
            $status= request('status');
        }
        $transactions = $query->where('user_id',Auth::user()->id)->get();

        return view('social.transaction.index', compact('transactions','status'));
    }
}

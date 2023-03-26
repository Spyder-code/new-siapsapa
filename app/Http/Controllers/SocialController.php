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
use App\Models\Juri;
use App\Models\Kegiatan;
use App\Models\Lomba;
use App\Models\LombaStage;
use App\Models\PesertaLomba;
use App\Models\PointJuri;
use App\Models\PointVote;
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
        $kegiatan = Kegiatan::where('agenda_id', $agenda->id)->orderBy('waktu_mulai', 'asc')->get()->groupBy('waktu_mulai');
        $lomba = Lomba::join('kegiatan','kegiatan.id','=','lomba.kegiatan_id')
                    ->join('agenda','agenda.id','=','kegiatan.agenda_id')
                    ->where('agenda.id',$agenda->id)
                    ->select('lomba.*')
                    ->get();

        $juara = array();
        $tingkat = $agenda->tingkat;
        $index = 0;
        foreach ($lomba as $lom) {
            if ($lom->penilaian=='vote') {
                $data = PointVote::select('lomba_file_id')
                        ->selectRaw('count(*) as total')
                        ->groupBy('lomba_file_id')
                        ->orderByRaw('total desc')
                        ->take(3)->get();
                foreach ($data as $idx => $nilai) {
                    if($tingkat=='gudep'){
                        $juara[$index]['nama'] = $nilai->lomba_file->anggota->gudepInfo->nama_sekolah;
                    }
                    if($tingkat=='kecamatan'){
                        $juara[$index]['nama'] = $nilai->lomba_file->anggota->district->name;
                    }
                    if($tingkat=='kabupaten'){
                        $juara[$index]['nama'] = $nilai->lomba_file->anggota->city->name;
                    }
                    if($tingkat=='provinsi'){
                        $juara[$index]['nama'] = $nilai->lomba_file->anggota->province->name;
                    }
                    if($idx==0){
                        $juara[$index]['point'] = 100;
                    }
                    if($idx==1){
                        $juara[$index]['point'] = 45;
                    }
                    if($idx==2){
                        $juara[$index]['point'] = 20;
                    }
                    $index++;
                }
            }
            if ($lom->penilaian=='subjective') {
                $juriCount = Juri::where('lomba_id',$lom->id)->count();
                if ($lom->kepesertaan=='kelompok') {
                    $data = array();
                    $pen = PointJuri::all()->where('point','>',0)->where('lomba_id',$lom->id)->groupBy('peserta_id');
                    foreach ($pen as $key => $item) {
                        if($lom->kegiatan->agenda->tingkat=='provinsi'){
                            $name = $item->first()->peserta->anggota->province->name;
                        }elseif($lom->kegiatan->agenda->tingkat=='kabupaten'){
                            $name = $item->first()->peserta->anggota->city->name;
                        }elseif($lom->kegiatan->agenda->tingkat=='kecamatan'){
                            $name = $item->first()->peserta->anggota->district->name;
                        }else{
                            $name = $item->first()->peserta->anggota->gudepInfo->nama_sekolah;
                        }
                        $data[$key]['nama'] = $name;
                        $data[$key]['point'] = $item->sum('point');
                    }
                    $data = collect($data);
                    $data = $data->sortByDesc('point');
                    $a = 0;
                    foreach ($data as $idx => $nilai) {
                        if($a<3){
                            $juara[$index]['nama'] = $nilai['nama'];
                            if($a==0){
                                $juara[$index]['point'] = 100;
                            }
                            if($a==1){
                                $juara[$index]['point'] = 45;
                            }
                            if($a==2){
                                $juara[$index]['point'] = 20;
                            }
                            $index++;
                        }
                        $a++;
                    }
                }else{
                    $data = array();
                    $pen = PesertaLomba::all()->where('lomba_id',$lom->id);
                    foreach ($pen as $key => $item) {
                        if($lom->kegiatan->agenda->tingkat=='provinsi'){
                            $name = $item->anggota->province->name;
                        }elseif($lom->kegiatan->agenda->tingkat=='kabupaten'){
                            $name = $item->anggota->city->name;
                        }elseif($lom->kegiatan->agenda->tingkat=='kecamatan'){
                            $name = $item->anggota->district->name;
                        }else{
                            $name = $item->anggota->gudepInfo->nama_sekolah;
                        }
                        $data[$key]['nama'] = $name;
                        $data[$key]['point'] = (int)PointJuri::all()->where('lomba_id',$lom->id)->whereNull('gudep_id')->where('peserta_id',$item->id)->sum('point');
                        $data[$key]['is_nilai'] = $data[$key]['point'] > 0 ? true : false;
                    }
                    $data = collect($data);
                    $data = $data->sortByDesc('point');
                    $a = 0;
                    foreach ($data as $idx => $nilai) {
                        if($a<3 && $nilai['is_nilai']){
                            $juara[$index]['nama'] = $nilai['nama'];
                            if($a==0){
                                $juara[$index]['point'] = 100;
                            }
                            if($a==1){
                                $juara[$index]['point'] = 45;
                            }
                            if($a==2){
                                $juara[$index]['point'] = 20;
                            }
                            $index++;
                        }
                        $a++;
                    }
                }
            }
            if ($lom->penilaian=='objective') {
                if($lom->kepesertaan=='kelompok'){
                    $data = LombaStage::join('peserta_lomba','peserta_lomba.id','=','lomba_stages.peserta_id')
                            ->join('tb_anggota','tb_anggota.id','=','peserta_lomba.anggota_id')
                            ->where('lomba_stages.lomba_id',$lom->id)
                            ->select('lomba_stages.*','tb_anggota.provinsi','tb_anggota.kabupaten','tb_anggota.kecamatan','tb_anggota.gudep')
                            ->orderBy('stage','desc')
                            ->get()
                            ->groupBy($lom->kegiatan->agenda->tingkat);
                }else{
                    $data = LombaStage::where('lomba_id',$lom->id)->orderBy('stage','desc')->orderBy('point','desc')->get()->groupBy('peserta_id');
                }
                foreach ($data as $idx => $nilai) {
                    if($idx<3){
                        if($tingkat=='gudep'){
                            $juara[$index]['nama'] = $nilai->first()->peserta->anggota->gudepInfo->nama_sekolah;
                        }
                        if($tingkat=='kecamatan'){
                            $juara[$index]['nama'] = $nilai->first()->peserta->anggota->district->name;
                        }
                        if($tingkat=='kabupaten'){
                            $juara[$index]['nama'] = $nilai->first()->peserta->anggota->city->name;
                        }
                        if($tingkat=='provinsi'){
                            $juara[$index]['nama'] = $nilai->first()->peserta->anggota->province->name;
                        }
                        if($a==0){
                            $juara[$index]['point'] = 100;
                        }
                        if($a==1){
                            $juara[$index]['point'] = 45;
                        }
                        if($a==2){
                            $juara[$index]['point'] = 20;
                        }
                        $index++;
                    }
                }
            }
        }


        $grouped = array();
        foreach ($juara as $object) {
            if (!isset($grouped[$object['nama']])) {
                $grouped[$object['nama']] = array();
            }
            $grouped[$object['nama']][] = $object;
        }

        $champion = array();
        foreach($juara as $jua){
            if(isset($champion[$jua['nama']]))
                $champion[$jua['nama']] += $jua['point'];
            else
                $champion[$jua['nama']] = $jua['point'];
        }

        $umum = array();
        $p = 0;
        foreach ($champion as $key => $value) {
            $one = 0;
            $two = 0;
            $three = 0;
            foreach($grouped[$key] as $poin){
                if( $poin['point']==100){
                    $one++;
                }
                if( $poin['point']==45){
                    $two++;
                }
                if( $poin['point']==20){
                    $three++;
                }
            }
            $umum[$p]['data'] = $grouped[$key];
            $umum[$p]['nama'] = $key;
            $umum[$p]['point'] = $value;
            $umum[$p]['one'] = $one;
            $umum[$p]['two'] = $two;
            $umum[$p]['three'] = $three;
            $p++;
        }

        usort($umum, fn($a, $b) => strcmp($b['point'], $a['point']));
        $collect = collect($umum);
        $umum = $collect->sortByDesc('point');
        return view('social.event-detail', compact('agenda', 'kegiatan','umum'));
    }

    public function cart()
    {
        $role = Auth::user()->role;
        if ($role=='anggota') {
            $carts = Cart::where('anggota_id', Auth::user()->anggota->id)->with('anggota')->get();
        }else{
            $carts = Cart::where('user_id', Auth::id())->with('anggota')->get();
        }
        $pramuka = Pramuka::all();
        return view('social.cart', compact('carts','pramuka'));
    }

    public function createTransaction()
    {
        $role = Auth::user()->role;
        if ($role=='gudep') {
            $gudep = Auth::user()->anggota->gudep;
            $data = Cart::whereHas('anggota', function($q) use($gudep){
                $q->where('gudep',$gudep);
            })->get();
            foreach ($data as $item ) {
                $item->update(['user_id'=>Auth::id()]);
            }
        } else {
            $data = Cart::where('user_id', Auth::id())->with('anggota')->get();
        }
        $count = $data->count();
        $total = $data->sum('harga');
        $weight = $data->count() * 10;
        if($count<5){
            return back()->with('danger','Minimal pesan 5 KTA untuk melakukan transaksi');
        }
        return view('social.transaction.create', compact('total','weight'));
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

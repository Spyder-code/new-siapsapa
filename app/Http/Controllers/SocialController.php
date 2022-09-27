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
      $agenda = Agenda::all();
      foreach ($agenda as $item) {
         $time = strtotime($item->tanggal_selesai);
         $now = strtotime(date('Y-m-d'));
         if ($time > $now) {
            $item->is_finish = 0;
         }
         else {
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
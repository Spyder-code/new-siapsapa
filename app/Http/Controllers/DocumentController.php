<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use App\Models\Pramuka;
use App\Repositories\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $cek = Auth::user()->anggota;
        if(request('anggota_id')){
            $cek = Anggota::find(request('anggota_id'));
        }
        if($cek->pramuka==3 || $cek->pramuka==4){
            $pramuka = Pramuka::where('id','!=',5)->pluck('name','id');
        }else{
            $pramuka = Pramuka::where('id','!=',5)->where('id','!=','8')->pluck('name','id');
        }
        $mydocument = Document::all()->where('user_id', $cek->user_id)->groupBy('pramuka');
        $data = Document::where('status',0)->with('user', function($q){
            $q->with('anggota', function($qu){
                $qu->where('kabupaten', Auth::user()->anggota->kabupaten);
            });
        })->get();
        return view('admin.document.index', compact('pramuka','mydocument','data','cek'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sertif' => 'required|image|max:2048',
            'document_type_id' => 'required',
            'pramuka' => 'required',
            'user_id' => 'required',
        ]);

        $service = new DocumentService();
        $service->insertDocument($data);
        return back()->with('success', 'Document berhasil diupload');
    }

    public function update(Request $request, Document $dokuman)
    {
        $dokuman->update($request->all());
        if ($request->status==1) {
            $service = new DocumentService();
            $service->checkStatus($dokuman->user_id);
        }
        return back()->with('success', 'Document berhasil diupdate');
    }
}

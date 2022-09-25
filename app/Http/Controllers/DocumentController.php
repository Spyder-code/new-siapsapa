<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Pramuka;
use App\Repositories\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $pramuka = Pramuka::where('id','!=',5)->pluck('name','id');
        $mydocument = Document::all()->where('user_id', Auth::id())->groupBy('pramuka');
        $data = Document::where('status',0)->with('user', function($q){
            $q->with('anggota', function($qu){
                $qu->where('kabupaten', Auth::user()->anggota->kabupaten);
            });
        })->get();
        return view('admin.document.index', compact('pramuka','mydocument','data'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sertif.0' => 'required|image|max:2048',
            'document_type_id' => 'required',
            'pramuka' => 'required',
        ]);

        $service = new DocumentService();
        $service->insertDocument($data);
        return back()->with('success', 'Document berhasil diupload');
    }

    public function update(Request $request, Document $dokuman)
    {
        $dokuman->update($request->all());
        $service = new DocumentService();
        $service->checkStatus($dokuman->user_id);
        return back()->with('success', 'Document berhasil diupdate');
    }
}

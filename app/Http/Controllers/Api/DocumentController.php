<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Pramuka;
use App\Repositories\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function getDocumentTypeByPramukaId($id)
    {
        $document_type = DocumentType::where('pramuka_id', $id)->select('id','pramuka_id','name')->get();
        return response()->json($document_type);
    }

    public function getPramuka()
    {
        $pramuka = Pramuka::select('id','name')->get();
        return response()->json($pramuka);
    }

    public function getDocumentByUserId()
    {
        $user = Auth::user();
        $document = Document::where('user_id', $user->id)->get();
        return response()->json($document);
    }

    public function store()
    {
        $data = request()->all();
        $data['pramuka'] = DocumentType::find($data['document_type_id'])->pramuka_id;
        $service = new DocumentService();
        $res = $service->insertDocument($data);
        return response()->json([
            'message' => 'Dokumen berhasil diupload',
            'status' => 'success',
            'data' => $res
        ]);
    }

    public function deleteDocument()
    {
        $document_id = request('document_id');
        $user_id = request('user_id');
        $check = Document::where('id', $document_id)->where('user_id', $user_id)->first();
        if($check == null){
            return response()->json([
                'message' => 'Dokumen tidak ditemukan',
                'status' => 'error'
            ]);
        }
        Document::destroy($document_id);
        $data = Document::where('user_id', $user_id)->get();
        if($data->count() > 0){
            $tingkat = $data->max('document_type_id');
            Anggota::where('user_id', $user_id)->update(['tingkat'=>$tingkat]);
        }else{
            Anggota::where('user_id', $user_id)->update(['tingkat'=>null]);
        }

        return response()->json(['success'=>'Document berhasil dihapus']);
    }
}

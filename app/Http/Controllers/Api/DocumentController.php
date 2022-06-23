<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function getDocumentTypeByPramukaId($id)
    {
        $document_type = DocumentType::where('pramuka_id', $id)->get();
        return response()->json($document_type);
    }

    public function deleteDocument()
    {
        $document_id = request('document_id');
        $user_id = request('user_id');
        Document::destroy($document_id);
        $data = Document::where('user_id', $user_id)->get();
        if($data>0){
            $tingkat = $data->max('document_type_id');
            Anggota::where('user_id', $user_id)->update(['tingkat'=>$tingkat]);
        }else{
            Anggota::where('user_id', $user_id)->update(['tingkat'=>null]);
        }

        return response()->json(['success'=>'Document berhasil dihapus']);
    }
}

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
        $anggota = Anggota::where('user_id',$user_id)->first();
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
            $tingkat = Document::all()->where('user_id', $user_id)->where('status',1)->max('document_type_id');
            $pramuka = Document::all()->where('user_id', $user_id)->where('status',1)->max('pramuka');
            $anggota->update(['tingkat'=>$tingkat,'pramuka'=>$pramuka]);
        }else{
            if($anggota->kawin==1){
                $golongan = 5;
            }else{
                $usia = umur($anggota->tgl_lahir);
                if ($usia[0] < 10) {
                    $golongan = 1;
                } else if ($usia[0] >= 10 && $usia[0] <= 15) {
                    $golongan = 2;
                } else if ($usia[0] >= 16 && $usia[0] <= 20) {
                    $golongan = 3;
                } else if ($usia[0] >= 21 && $usia[0] < 25) {
                    $golongan = 4;
                } else if ($usia[0] >= 25) {
                    $golongan = 5;
                }
            }
            $anggota->update(['tingkat'=>null,'pramuka'=>$golongan]);
        }

        return response()->json(['success'=>'Document berhasil dihapus']);
    }
}

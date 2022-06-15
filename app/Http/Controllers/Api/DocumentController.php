<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function getDocumentTypeByPramukaId($id)
    {
        $document_type = DocumentType::where('pramuka_id', $id)->get();
        return response()->json($document_type);
    }
}

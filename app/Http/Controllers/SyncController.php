<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function document()
    {
        $data = Document::all();
        foreach ($data as $item ) {
            $item->pramuka = $item->documentType->pramuka_id;
            $item->save();
        }

    }
}

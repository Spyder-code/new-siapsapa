<?php namespace App\Repositories;

use App\Models\Anggota;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentService {

    public function insertDocument($data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;
        $file = $data['sertif'];
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('/berkas/dokumen'.'/'.$data['document_type_id']), $fileName);
        $data['file'] = $fileName;

        if($user->role != 'anggota'){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        $check = Document::where('user_id', Auth::id())->where('document_type_id', $data['document_type_id'])->first();
        if($check && $check->pramuka != 8){
            $check->update($data);
        }else{
            $check = Document::create($data);
        }

        $this->checkStatus($user->id);

        return $check;
    }

    public function checkStatus($user_id)
    {
        $tingkat = Document::all()->where('user_id', $user_id)->where('status',1)->max('document_type_id');
        $pramuka = Document::all()->where('user_id', $user_id)->where('status',1)->max('pramuka');
        Anggota::where('user_id', $user_id)->update(['tingkat' => $tingkat, 'pramuka' => $pramuka]);
        return 'success';
    }
}

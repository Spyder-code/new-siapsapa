<?php namespace App\Repositories;

use App\Models\Anggota;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentService {

    public function insertDocument($data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;
        $file = $data['file'];
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('/berkas/dokumen'.'/'.$data['document_type_id']), $fileName);
        $data['file'] = $fileName;

        if($user->role != 'anggota'){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        $check = Document::where('user_id', Auth::id())->where('document_type_id', $data['document_type_id'])->first();
        if($check){
            $check->update($data);
        }else{
            Document::create($data);
        }

        $this->checkStatus($user->id);

        return 'success';
    }

    public function checkStatus($user_id)
    {
        $data = Document::all()->where('user_id', $user_id)->where('status',1)->max('document_type_id');
        Anggota::where('user_id', $user_id)->update(['tingkat' => $data]);
        return $data;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DataController extends Controller
{
    public function view_date()
    {
        return view('admin.data.wrong_date');
    }

    public function view_image()
    {
        return view('admin.data.wrong_image');
    }

    public function update_tgl_lahir(Request $request)
    {
        $validator = $request->validate([
            'tgl_lahir'    => 'required|array',
            'tgl_lahir.*'  => 'required|date_format:d/m/Y',
        ], [
            'tgl_lahir.*.required' => 'Tanggal lahir tidak boleh kosong',
            'tgl_lahir.*.date_format' => 'Format tanggal lahir salah',
        ]);

        $anggota = Anggota::whereIn('id', $request->id)->get();
        foreach ($anggota as $key => $item) {
            $item->tgl_lahir = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir[$key])->format('Y-m-d');;
            $item->save();
        }
        return back()->with('success', 'Berhasil mengubah tanggal lahir');
    }

    public function wrong_date()
    {
        $user = Auth::user();
        $role = $user->role;
        $query = Anggota::query();
        if($role=='admin')
            $query->get();
        if($role=='kwarda')
            $query->where('provinsi',$user->anggota->provinsi);
        if($role=='kwarcab')
            $query->where('kabupaten',$user->anggota->kabupaten);
        if($role=='kwaran')
            $query->where('kecamatan',$user->anggota->kecamatan);
        if($role=='gudep'){
            $query->where('gudep',$user->anggota->gudep);
        }
        $query->where('tgl_lahir','0000-00-00');
        $data = $query->select('id','nama','email','tgl_lahir');
        return DataTables::of($data)
            ->addColumn('tgl_lahir', function ($data) {
                $html = '
                <input type="text" name="tgl_lahir[]" value="00/00/0000" class="form-control tgl-lahir" id="tgl_lahir">
                <input type="hidden" name="id[]" value="'.$data->id.'" class="form-control" id="id">';
                return $html;
            })
            ->rawColumns(['tgl_lahir'])
            ->make(true);
    }

    public function wrong_image()
    {
        $user = Auth::user();
        $role = $user->role;
        $query = Anggota::query();
        if($role=='admin')
            $query->get();
        if($role=='kwarda')
            $query->where('provinsi',$user->anggota->provinsi);
        if($role=='kwarcab')
            $query->where('kabupaten',$user->anggota->kabupaten);
        if($role=='kwaran')
            $query->where('kecamatan',$user->anggota->kecamatan);
        if($role=='gudep'){
            $query->where('gudep',$user->anggota->gudep);
        }
        $anggota = $query->get(['id','foto']);
        $arr = [];
        foreach ($anggota as $item ) {
            if (!file_exists( public_path('berkas/anggota/'.$item->foto) )) {
                array_push($arr, $item->id);
            }
        }

        $data = Anggota::whereIn('id',$arr)->select('id','nama','email','foto','pramuka');
        return DataTables::of($data)
            ->addColumn('foto', function($data){
                if($data->pramuka==1){
                    $warna = '<span class="badge bg-siaga">Siaga</span>';
                }elseif($data->pramuka==2){
                    $warna = '<span class="badge bg-penggalang">Penggalang</span>';
                }elseif($data->pramuka==3){
                    $warna = '<span class="badge bg-penegak">Penegak</span>';
                }elseif($data->pramuka==4){
                    $warna = '<span class="badge bg-pandega">Pandega</span>';
                }elseif($data->pramuka==5){
                    $warna = '<span class="badge bg-dewasa">Dewasa</span>';
                }
                return '
                    <div class="justify-content-center text-center">
                    <img id="foto-'.$data->id.'" src="'.asset('berkas/anggota/'.$data->foto).'" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                        '.$warna.'
                    </div>
                ';
            })
            ->addColumn('aksi', function ($data) {
                $html = '<a href="'.route('anggota.edit',$data).'" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>';
                return $html;
            })
            ->rawColumns(['foto','aksi'])
            ->make(true);

    }
}

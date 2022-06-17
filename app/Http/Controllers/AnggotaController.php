<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaRequest;
use App\Imports\AnggotaImport;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Provinsi;
use App\Repositories\AnggotaService;
use App\Repositories\WilayahService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Milon\Barcode\DNS2D;

class AnggotaController extends Controller
{
    public function index()
    {
        $is_gudep = false;
        $is_active = request('active');
        if(request('gudep')){
            $is_gudep = true;
        }
        if(request('id_wilayah')){
            $id_wilayah = request('id_wilayah');
        }else{
            $user = Auth::user();
            $role = $user->role;
            if($role=='admin')
                $id_wilayah = 'all';
            if($role=='kwarda')
                $id_wilayah = $user->anggota->provinsi;
            if($role=='kwarcab')
                $id_wilayah = $user->anggota->kabupaten;
            if($role=='kwaran' || $role=='gudep')
                $id_wilayah = $user->anggota->kecamatan;
        }

        $wilayah = new WilayahService($id_wilayah);
        $data = $wilayah->getData();
        $kwartir = $data[1];
        $title = $data[0]->name ?? 'Nasional';
        return view('admin.anggota.index', compact('is_gudep','is_active','data','id_wilayah','kwartir','title'));
    }

    public function create()
    {
        if(request('id_wilayah')){
            $id_wilayah = request('id_wilayah');
        }else{
            $user = Auth::user();
            $role = $user->role;
            if($role=='admin')
                $id_wilayah = 'all';
            if($role=='kwarda')
                $id_wilayah = $user->anggota->provinsi;
            if($role=='kwarcab')
                $id_wilayah = $user->anggota->kabupaten;
            if($role=='kwaran' || $role=='gudep')
                $id_wilayah = $user->anggota->kecamatan;
        }

        $wilayah = new WilayahService($id_wilayah);
        $data = $wilayah->getData();
        if($data[0]==null){
            $data[0] = Provinsi::pluck('name', 'id');
        }

        return view('admin.anggota.create', compact('data'));
    }

    public function edit(Anggota $anggotum)
    {
        $anggota = $anggotum;
        if( Auth::user()->role == 'anggota'){
            if($anggota->user_id != Auth::user()->id){
                return abort(404);
            }
        }
        if(request('id_wilayah')){
            $id_wilayah = request('id_wilayah');
        }else{
            $user = Auth::user();
            $role = $user->role;
            if($role=='admin')
                $id_wilayah = 'all';
            if($role=='kwarda')
                $id_wilayah = $user->anggota->provinsi;
            if($role=='kwarcab')
                $id_wilayah = $user->anggota->kabupaten;
            if($role=='kwaran')
                $id_wilayah = $user->anggota->kecamatan;
        }

        $wilayah = new WilayahService($id_wilayah);
        $data = $wilayah->getData();
        if($data[0]==null){
            $data[0] = Provinsi::pluck('name', 'id');
        }

        return view('admin.anggota.edit', compact('data','anggota'));
    }

    public function show(Anggota $anggotum)
    {
        $anggota = $anggotum;
        if( Auth::user()->role == 'anggota'){
            if($anggota->user_id != Auth::user()->id){
                return abort(404);
            }
        }
        // $data = DNS2D::getBarcodePNG('4445645656', 'PDF417');
        // dd($data);
        return view('admin.anggota.show', compact('anggota'));
    }

    public function import()
    {
        session()->forget('data-import-'.Auth::id());
        return view('admin.anggota.import');
    }

    public function import_excel(Request $request)
    {
        $file = $request->file('file');
        $import = new AnggotaImport();
        Excel::import($import, $file);
        $data = $import->getData();
        $error_arr = [];
        foreach ($data as $value) {
            if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $value['tgl_lahir'], $matches)) {
                if (!checkdate($matches[2], $matches[1], $matches[3])) {
                    $error = true;
                    array_push($error_arr, $value['nama']);
                }else{
                    $error = false;
                }
            } else {
                $error = true;
                array_push($error_arr, $value['nama']);
            }
        }

        return response()->json(['data' => $data, 'error' => $error_arr]);
    }

    public function import_foto(Request $request)
    {
        if ($files = $request->file('file')) {
            $order = $files->getClientOriginalName();
            $filePath = public_path('/berkas/import/foto');
            $profileImage = Auth::id().date('dmyHis'). random_int(1, 99999).'.'. $files->getClientOriginalExtension();
            $files->move($filePath, $profileImage);
            return response([
                'name' => $profileImage,
                'order' => $order,
            ]);
        }
    }

    public function import_confirm(Request $request)
    {
        $data = json_decode($request->data);
        $foto = json_decode($request->foto);
        $data = $data[0];
        foreach ($foto as $idx => $item) {
            $data[$idx]->foto = $item->name;
        }
        session()->put('data-import-'.Auth::id(), $data);
        return redirect()->route('anggota.import.confirm.view');
    }

    public function import_confirm_view()
    {
        $data = session()->get('data-import-'.Auth::id());
        return view('admin.anggota.import_confirm', compact('data'));
    }

    public function store_array(Request $request)
    {
        $validator = $request->validate([
            'nik'    => 'required|array',
            'nik.*'  => 'required|string|unique:tb_anggota,nik',
            'nama'    => 'required|array|min:3',
            'nama.*'  => 'required|string',
            'tgl_lahir'    => 'required|array',
            'tgl_lahir.*'  => 'required|date_format:d/m/Y',
            'alamat'    => 'required|array',
            'alamat.*'  => 'required|max:64',
        ], [
            'nik.*.required' => 'NIK tidak boleh kosong',
            'nik.*.unique' => 'NIK sudah terdaftar',
            'nama.*.required' => 'Nama tidak boleh kosong',
            'tgl_lahir.*.required' => 'Tanggal lahir tidak boleh kosong',
            'tgl_lahir.*.date_format' => 'Format tanggal lahir salah',
            'alamat.*.required' => 'Alamat tidak boleh kosong',
            'alamat.*.max' => 'Alamat terlalu panjang',
        ]);

        $data = $request->all();
        $service = new AnggotaService();
        $anggota = $service->createUserArray($data);
        session()->forget('data-import-'.Auth::id());
        return redirect()->route('anggota.index')->with('success', 'Import Data berhasil');
    }

    public function store(AnggotaRequest $request)
    {
        $data = $request->validated();
        $service = new AnggotaService();
        $anggota = $service->createUser($data);
        return redirect()->route('anggota.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(AnggotaRequest $request, Anggota $anggotum)
    {
        $data = $request->validated();
        $service = new AnggotaService();
        $anggota = $service->updateUser($data, $anggotum);
        return redirect()->route('anggota.index')->with('success', 'Data berhasil diubah');
    }

    public function data_table()
    {
        $id_wilayah = request('id_wilayah');
        $is_gudep = request('gudep');
        $status = request('active');
        $query = Anggota::query();
        if($is_gudep == 1){
            $query->whereNotNull('gudep');
        }else{
            $query->whereNull('gudep');
        }

        $query->where('status', $status);

        if($id_wilayah=='all'){
            $data = $query->select('id','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi');
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $data = $query->where('provinsi',$id_wilayah)->select('id','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi');
            }elseif($len==4){
                $data =  $query->where('kabupaten',$id_wilayah)->select('id','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi');
            }else{
                $data = $query->where('kecamatan',$id_wilayah)->select('id','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi');
            }

        }

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
                    <img src="'.asset('berkas/anggota/'.$data->foto).'" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                        '.$warna.'
                    </div>
                ';
            })
            ->addColumn('action', function ($data) use($status) {
                $btn = '';
                if($status==2){
                    $btn = '
                        <button type="button" onclick="validasi('.$data->id.')" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Validasi</button>
                    ';
                }
                $html = '<div class="btn-group">
                            <a href="'.route('anggota.edit',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Anggota" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            <a href="'.route('anggota.show',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Anggota" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Detail</a>
                            '.$btn.'
                        </div>';
                return $html;
            })
            ->addColumn('kabupaten', function ($data) {
                return $data->city->name;
            })
            ->addColumn('kecamatan', function ($data) {
                return $data->district->name;
            })
            ->rawColumns(['action','foto'])
            ->make(true);
    }

    public function warna($pramuka)
    {
        if($pramuka==1){
            return '<span class="badge badge-danger">Siaga</span>';
        }elseif($pramuka==2){
            return '<span class="badge badge-warning">Waspada</span>';
        }elseif($pramuka==3){
            return '<span class="badge badge-success">Kompeten</span>';
        }elseif($pramuka==4){
            return '<span class="badge badge-secondary">Tidak Pramuka</span>';
        }elseif($pramuka==5){
            return '<span class="badge badge-primary">Pramuka</span>';
        }
    }
}

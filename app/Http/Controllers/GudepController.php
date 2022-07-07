<?php

namespace App\Http\Controllers;

use App\Http\Requests\GudepRequest;
use App\Models\Anggota;
use App\Models\Gudep;
use App\Models\Provinsi;
use App\Repositories\GudepService;
use App\Repositories\WilayahService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class GudepController extends Controller
{
    public function index()
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
            if($role=='kwaran')
                $id_wilayah = $user->anggota->kecamatan;
            if($role=='gudep')
                $id_wilayah = $user->anggota->kecamatan;
        }

        $wilayah = new WilayahService($id_wilayah);
        $data = $wilayah->getData();
        $kwartir = $data[1];
        $title = $data[0]->name ?? 'Nasional';
        return view('admin.gudep.index', compact('data','id_wilayah','kwartir','title'));
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
            if($role=='kwaran')
                $id_wilayah = $user->anggota->kecamatan;
        }

        $wilayah = new WilayahService($id_wilayah);
        $data = $wilayah->getData();
        if($data[0]==null){
            $data[0] = Provinsi::pluck('name', 'id');
        }
        return view('admin.gudep.create', compact('data','id_wilayah'));
    }

    public function edit(Gudep $gudep)
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
        return view('admin.gudep.edit', compact('data','id_wilayah','gudep'));
    }

    public function show(Gudep $gudep)
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
        return view('admin.gudep.show', compact('data','id_wilayah','gudep'));
    }

    public function anggota(Gudep $gudep)
    {
        $active = request('active');
        if($active==null){
            $active = 'all';
        }
        return view('admin.gudep.anggota', compact('gudep','active'));
    }

    public function transfer()
    {
        $gudep = Gudep::find(Auth::user()->anggota->gudep);
        return view('admin.gudep.transfer', compact('gudep'));
    }

    public function transfer_store(Request $request)
    {
        $anggota = Anggota::where('email', $request->email)->where('status','!=',1)->first();
        if($anggota){
            $user = $anggota->user;
            if(!password_verify($request->password, $user->password)){
                return back()->with('error', 'Password salah');
            }else{
                $anggota->gudep = $request->gudep;
                $anggota->save();
                return back()->with('success', $anggota->nama.' berhasil di transfer ke gudep');
            }
        }else{
            return back()->with('error', 'Anggota tidak ditemukan');
        }
    }

    public function store()
    {
        Gudep::create(request()->all());
        return redirect()->route('gudep.index');
    }

    public function update(GudepRequest $request,Gudep $gudep)
    {;
        $gudep->update($request->all());
        $service = new GudepService();
        $service->updateKodeAnggota($gudep->id);
        $role = Auth::user()->role;
        if ($role=='gudep') {
            return redirect()->route('gudep.show',$gudep);
        }
        return redirect()->route('gudep.index');
    }

    public function data_table()
    {
        $id_wilayah = request('id_wilayah');
        if($id_wilayah=='all'){
            $data = Gudep::select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                $q->whereHas('user', function($q){
                    $q->where('role', 'gudep');
                });
            },
            'anggota as anggota' => function($q){
                $q->whereHas('user', function($q){
                    $q->where('role', 'anggota');
                });
            }]);
            $type = 1;
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $data = Gudep::where('provinsi',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },'anggota as anggota']);
                $type = 2;
            }elseif($len==4){
                $data =  Gudep::where('kabupaten',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },'anggota as anggota']);
                $type = 3;
            }else{
                $data = Gudep::where('kecamatan',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },'anggota as anggota']);
                $type = 4;
            }
        }

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $html = '<div class="btn-group">
                                <a href="'.route('gudep.show', $data).'" class="btn btn-sm btn-primary">Detail Gudep</a>
                                <button type="button" onclick="showAdmin('.$data->id.',\'gudep\')" class="btn btn-sm btn-info">Lihat Admin</button>
                            </div>';
                return $html;
            })
            ->addColumn('tools', function ($data) {
                $html = '<a class="dropdown-item" href="'.route('gudep.edit',$data).'">
                                <i class="fa fa-pencil-alt me-1"></i> Edit Gudep
                            </a>
                            <button type="button" class="dropdown-item" onclick="deleteGudep('.$data->id.')">
                                <i class="fa fa-trash-alt me-1"></i> Delete Gudep
                            </button>';
                return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                '.$html.'
                            </div>
                        </div>';
            })
            ->rawColumns(['action','tools','statistik'])
            ->make(true);
    }

    public function data_table_anggota()
    {
        $gudep = request('gudep');
        $active = request('active');
        if($active=='all'){
            $data = Anggota::where('gudep',$gudep)->where('status',1)->select('id','nik','user_id','nama','foto','kode','tgl_lahir','jk','kabupaten','kecamatan','pramuka','status')->orderBy('id','desc')->with('user:id,role');
        }else{
            $data = Anggota::where('gudep',$gudep)->where('status',$active)->select('id','nik','user_id','nama','foto','kode','tgl_lahir','jk','kabupaten','kecamatan','pramuka','status')->orderBy('id','desc')->with('user:id,role');
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
            ->addColumn('kecamatan', function($data){
                return $data->city->name;
            })
            ->addColumn('status', function($data){
                $name = $data->status == 0 ? 'Tidak Aktif' : 'Aktif';
                $value = $data->status == 0 ? 1 : 0;
                $is_check = $data->status== 0 ? '' : 'checked';
                $html = '<form action="' . route('anggota.update.status', $data) . '" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" value="' . $value . '" name="status">
                                <div class="form-check form-switch">
                                    <input '.$is_check.' class="form-check-input" type="checkbox" onchange="submit()" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">' . $name . '</label>
                                </div>
                                </button>
                            </form>';

                return $html;
            })
            ->addColumn('kabupaten', function($data){
                return $data->district->name;
            })
            ->addColumn('action', function ($data) {
                $add = '';
                if($data->user->role=='anggota'){
                    $add = '<button type="button" onclick="addAdmin('.$data->id.')" class="btn btn-sm btn-success">Tambah Admin</button>';
                }
                $html = ' <a href="'.route('anggota.show',$data->id).'" class="btn btn-sm btn-primary">Detail Anggota</a>
                '.$add.'';
                return '<div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu px-2">
                        '.$html.'
                        <button type="button" onclick="deleteAnggota('.$data->id.')" class="btn btn-sm btn-danger">Hapus Anggota</button>
                    </div>
                </div>';
            })
            ->rawColumns(['action','foto','status'])
            ->make(true);
    }
}

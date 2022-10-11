<?php

namespace App\Http\Controllers;

use App\Http\Requests\GudepRequest;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Gudep;
use App\Models\Pramuka;
use App\Models\Provinsi;
use App\Models\TransferAnggota;
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
        $plk = Anggota::where('gudep',$gudep->id)->where('status',1)->where('pramuka',5)->where('jk','L')->count();
        $ppr = Anggota::where('gudep',$gudep->id)->where('status',1)->where('pramuka',5)->where('jk','P')->count();
        $pramuka = Pramuka::whereIn('id',[1,2,3,4,6,7])->get();
        return view('admin.gudep.show', compact('data','id_wilayah','gudep','pramuka','plk','ppr'));
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
        $transferFrom = TransferAnggota::where('from_gudep', $gudep->id)->get();
        $transferTo = TransferAnggota::where('to_gudep', $gudep->id)->get();
        return view('admin.gudep.transfer', compact('gudep','transferFrom','transferTo'));
    }

    public function transfer_store(Request $request)
    {
        $anggota = Anggota::where('nik', $request->nik)->first();
        // dd($anggota->gudep);
        if($anggota){
            if($request->gudep_id > 0){
                if ($anggota->gudep!=null) {
                    TransferAnggota::create([
                        'anggota_id' => $anggota->id,
                        'from_gudep' => $request->from_gudep,
                        'to_gudep' => $request->gudep_id,
                        'user_created' => Auth::id(),
                        'status' => 0,
                    ]);
                    return back()->with('success', 'Permintaan transfer anggota telah di buat. Silahkan menunggu gudep tujuan untuk menyetujui permintaan');
                }else{
                    return back()->with('error','Anggota tidak terdaftar dari gudep asal! harap hubungi admin ranting untuk menambahkan');
                }
            }else{
                return back()->with('error', 'Gudep tidak ditemukan');
            }
            // $user = $anggota->user;
            // if(!password_verify($request->password, $user->password)){
            //     return back()->with('error', 'Password salah');
            // }else{
            //     $anggota->gudep = $request->gudep;
            //     $anggota->kode = $this->generateCode($anggota->kecamatan, $request->gudep, $anggota->jk);
            //     $anggota->save();
            //     return back()->with('success', $anggota->nama.' berhasil di transfer ke gudep');
            // }
        }else{
            return back()->with('error', 'NIK Anggota tidak ditemukan');
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
        $limit = request('length');
        $start = request('start') * request('length');
        if($id_wilayah=='all'){
            if($limit==-1){
                $limit = Gudep::count();
            }
            $data = Gudep::select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                $q->whereHas('user', function($q){
                    $q->where('role', 'gudep');
                });
            },
            'anggota as anggota' => function($q){
                $q->whereHas('user', function($q){
                    $q->where('role', 'anggota');
                });
            }])->offset($start)->limit($limit);
            $count = Gudep::select('id')->count();
            $type = 1;
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                if($limit==-1){
                    $limit = Gudep::where('provinsi', $id_wilayah)->count();
                }
                $data = Gudep::where('provinsi',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },'anggota as anggota'])->offset($start)->limit($limit);
                $count = Gudep::where('provinsi',$id_wilayah)->select('id')->count();
                $type = 2;
            }elseif($len==4){
                if($limit==-1){
                    $limit = Gudep::where('kabupaten', $id_wilayah)->count();
                }
                $data =  Gudep::where('kabupaten',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },'anggota as anggota'])->offset($start)->limit($limit);
                $count = Gudep::where('kabupaten',$id_wilayah)->select('id')->count();
                $type = 3;
            }else{
                if($limit==-1){
                    $limit = Gudep::where('kecamatan', $id_wilayah)->count();
                }
                $data = Gudep::where('kecamatan',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },'anggota as anggota'])->offset($start)->limit($limit);
                $count = Gudep::where('kecamatan',$id_wilayah)->select('id')->count();
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
            ->setFilteredRecords($count)
            ->rawColumns(['action','tools','statistik'])
            ->make(true);
    }

    public function data_table_anggota()
    {
        $limit = request('length');
        $start = request('start') * request('length');
        $gudep = request('gudep');
        $active = request('active');
        if($active=='all'){
            if($limit==-1){
                $limit = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',1)->count();
            }
            $data = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',1)->select('id','nik','user_id','nama','foto','kode','tgl_lahir','jk','kabupaten','kecamatan','pramuka','status')->orderBy('id','desc')->with('user:id,role')->offset($start)->limit($limit);
            $count = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',1)->count();
        }else{
            if($limit==-1){
                $limit = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',$active)->count();
            }
            $data = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',$active)->select('id','nik','user_id','nama','foto','kode','tgl_lahir','jk','kabupaten','kecamatan','pramuka','status')->orderBy('id','desc')->with('user:id,role')->offset($start)->limit($limit);
            $count = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',$active)->count();
        }

        return DataTables::of($data)
            ->addColumn('nama', function($data){
                return $data->nama.' ('.$data->kode.')';
            })
            ->addColumn('jk', function($data){
                $nama = strtoupper($data->jk[0]) == 'P' ? 'Perempuan' : 'Laki-laki';
                $date = date('d/m/Y', strtotime($data->tgl_lahir));
                return $nama.' ('.$date.')';
            })
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
                }else{
                    $warna = '<span class="badge bg-white text-dark">Pelatih</span>';
                }
                return '
                    <div class="justify-content-center text-center">
                    <img src="'.asset('berkas/anggota/'.$data->foto).'" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                        '.$warna.'
                    </div>
                ';
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
            ->addColumn('action', function ($data) {
                $btn = '';
                $status = $data->status;
                if($status==2){
                    $btn = '
                        <button type="button" onclick="validasi('.$data->id.')" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Validasi</button>
                        <button type="button" onclick="tolak('.$data->id.')" class="btn btn-secondary btn-sm"><i class="fa fa-crosshairs"></i> Tolak</button>
                    ';
                }
                $html = '<div class="btn-group">
                            <a href="'.route('anggota.edit',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Anggota" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            <a href="'.route('anggota.show',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Anggota" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Detail</a>
                            '.$btn.'
                            <button type="button" onclick="deleteAnggota('.$data->id.')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>  Hapus</button>
                        </div>';
                return $html;
            })
            ->addColumn('kabupaten', function ($data) {
                return $data->city->name;
            })
            ->addColumn('kecamatan', function ($data) {
                return $data->district->name;
            })
            ->setFilteredRecords($count)
            ->rawColumns(['action','foto','status'])
            ->make(true);
    }

    public function generateCode($kecamatan, $gudep = null, $jk = null)
    {
        $kec = Distrik::find($kecamatan);
        $kab = City::find($kec->regency_id);
        $prov = Provinsi::find($kab->province_id);
        $kode_wil = $prov->no_prov .'.'. $kab->no_kab .'.'. $kec->no_kec .'.';
        if ($gudep == null) {
            $kode_gudep = '000';
        }else{
            $gud = Gudep::find($gudep);
            if($jk=='Perempuan'){
                $kode_gudep = $gud->no_putri;
            }else{
                $kode_gudep = $gud->no_putra;
            }
        }

        $rand = rand(99999, 999999);
        $kode = $kode_wil . $kode_gudep .'.'. $rand;
        return $kode;
    }
}

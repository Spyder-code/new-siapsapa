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
        $cetak = Anggota::where('gudep',$gudep->id)->where('is_cetak',1)->count();
        $pramuka = Pramuka::whereIn('id',[1,2,3,4,6,7])->get();
        return view('admin.gudep.show', compact('data','id_wilayah','gudep','pramuka','plk','ppr','cetak'));
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
            $gudep = Gudep::find($request->from_gudep);
            if ($anggota->gudep!=null) {
                if($anggota->status==0){
                    $kode = $this->generateCodeGudep($gudep,strtoupper($anggota->jk[0]));
                    $anggota->update(['kode'=>$kode,'gudep'=>$request->from_gudep,'status'=>1]);
                    TransferAnggota::create([
                        'anggota_id' => $anggota->id,
                        'from_gudep' => $anggota->gudep,
                        'to_gudep' => $request->from_gudep,
                        'user_created' => Auth::id(),
                        'status' => 1,
                    ]);
                    return back()->with('success', 'Transfer anggota berhasil');
                }else{
                    TransferAnggota::create([
                        'anggota_id' => $anggota->id,
                        'from_gudep' => $anggota->gudep,
                        'to_gudep' => $request->from_gudep,
                        'user_created' => Auth::id(),
                        'status' => 0,
                    ]);
                    return back()->with('success', 'Permintaan transfer anggota telah di buat. Silahkan menunggu gudep tujuan untuk menyetujui permintaan');
                }
            }else{
                $kode = $this->generateCodeGudep($gudep,strtoupper($anggota->jk[0]));
                $anggota->update(['kode'=>$kode,'gudep'=>$request->from_gudep,'status'=>1]);
                return back()->with('success','Anggota berhasil ditransfer');
            }
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
        return redirect()->route('gudep.show',$gudep);
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
            $data = Gudep::select('id', 'nama_sekolah', 'npsn')->offset($start)->limit($limit);
            $count = Gudep::select('id')->count();
            $type = 1;
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                if($limit==-1){
                    $limit = Gudep::where('provinsi', $id_wilayah)->count();
                }
                $data = Gudep::where('provinsi',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->offset($start)->limit($limit);
                $count = Gudep::where('provinsi',$id_wilayah)->select('id')->count();
                $type = 2;
            }elseif($len==4){
                if($limit==-1){
                    $limit = Gudep::where('kabupaten', $id_wilayah)->count();
                }
                $data =  Gudep::where('kabupaten',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->offset($start)->limit($limit);
                $count = Gudep::where('kabupaten',$id_wilayah)->select('id')->count();
                $type = 3;
            }else{
                if($limit==-1){
                    $limit = Gudep::where('kecamatan', $id_wilayah)->count();
                }
                $data = Gudep::where('kecamatan',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->offset($start)->limit($limit);
                $count = Gudep::where('kecamatan',$id_wilayah)->select('id')->count();
                $type = 4;
            }
        }

        return DataTables::of($data)
            ->addColumn('admin', function($data){
                $count = Anggota::where('gudep',$data->id)->where('status',1)->whereHas('user', function($q){
                    $q->where('role','gudep');
                })->count();
                return $count;
            })
            ->addColumn('anggota', function($data){
                $count = Anggota::where('gudep',$data->id)->where('status',1)->count();
                return $count;
            })
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
                            </a>';
                $del = '';
                $count = Anggota::where('gudep',$data->id)->where('status',1)->count();
                if($count==0){
                    $del = '<button type="button" class="dropdown-item" onclick="deleteGudep('.$data->id.')">
                                <i class="fa fa-trash-alt me-1"></i> Delete Gudep
                            </button>';
                }
                return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                '.$html.$del.'
                            </div>
                        </div>';
            })
            ->setFilteredRecords($count)
            ->rawColumns(['action','tools','statistik'])
            ->make(true);
    }

    public function syncNoKta()
    {
        $anggota = Anggota::all()->where('gudep',request('gudep'));
        foreach ($anggota as $item) {
            $kode = $item->kode;
            $arr = explode('.',$kode);
            $depan = $arr[0].'.'.$arr[1].'.'.$arr[2].'.';
            $belakang = '.'.end($arr);
            $lk = $item->gudepInfo->no_putra;
            $pr = $item->gudepInfo->no_putri;
            if ($item->jk=='L') {
                $new = $depan.$lk.$belakang;
            }else{
                $new = $depan.$pr.$belakang;
            }
            $item->update([
                'kode' => $new
            ]);
        }

        return response('Sinkronisasi berhasil!');
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
            $data = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',1)->select('id','nik','is_cetak','status','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi','user_id')->offset($start)->limit($limit);
            $count = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',1)->count();
        }else{
            if($limit==-1){
                $limit = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',$active)->count();
            }
            $data = Anggota::where('user_id','!=',1)->where('gudep',$gudep)->where('status',$active)->select('id','nik','is_cetak','status','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi','user_id')->offset($start)->limit($limit);
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
                }elseif($data->pramuka==6){
                    $warna = '<span class="badge bg-dewasa">Pembina</span>';
                }elseif($data->pramuka==7){
                    $warna = '<span class="badge bg-dewasa">Pelatih</span>';
                }elseif($data->pramuka==8){
                    $warna = '<span class="badge bg-dewasa">Saka</span>';
                }else{
                    $warna = '<span class="badge bg-white text-dark">-</span>';
                }
                if ($data->is_cetak==1) {
                    $warna.='<br><span class="text-success" style=" position:relative; font-size:1.4rem"><i class="fas fa-check-circle"></i></span>';
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
                if($data->user->role=='anggota'){
                    $adm = '<button type="button" onclick="addAdmin('.$data->id.')" class="btn btn-sm btn-success">Tambah Sebagai Admin</button>';
                }else{
                    $adm = '<button type="button" onclick="deleteAdmin('.$data->id.')" class="btn btn-sm btn-secondary">Delete Admin</button>';
                }
                $html = '<div class="btn-group" style="white-space:nowrap">
                            <a href="'.route('anggota.edit',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Anggota" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            <a href="'.route('dokumen.index',['anggota_id'=>$data->id]).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Dokumen Anggota" class="btn btn-sm btn-primary"><i class="fas fa-book"></i> Dokumen</a>
                            <a href="'.route('anggota.show',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Anggota" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Detail</a>
                            '.$btn.$adm.'
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

    public function generateCodeGudep(Gudep $gudep, $jk = null)
    {
        $kec = Distrik::find($gudep->kecamatan);
        $kab = City::find($gudep->kabupaten);
        $prov = Provinsi::find($gudep->provinsi);
        $kode_wil = $prov->no_prov .'.'. $kab->no_kab .'.'. $kec->no_kec .'.';
        if($jk=='P'){
            $kode_gudep = $gudep->no_putri;
        }else{
            $kode_gudep = $gudep->no_putra;
        }

        $rand = rand(99999, 999999);
        $kode = $kode_wil . $kode_gudep .'.'. $rand;
        return $kode;
    }
}

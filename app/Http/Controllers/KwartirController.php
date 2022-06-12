<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCode;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Gudep;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class KwartirController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        if (request('id_wilayah')) {
            $id_wilayah = request('id_wilayah');
        }else{
            if($role=='admin')
                $id_wilayah = 'all';
            if($role=='kwarda')
                $id_wilayah = $user->anggota->provinsi;
            if($role=='kwarcab')
                $id_wilayah = $user->anggota->kabupaten;
            if($role=='kwaran')
                $id_wilayah = $user->anggota->kecamatan;
        }
        // dd($role);

        $data = $this->getData($id_wilayah);
        $title = $data[0]->name ?? 'Nasional';
        $kwartir = $data[1];
        return view('admin.kwartir.index', compact('id_wilayah', 'title', 'kwartir'));
    }

    public function edit($kwartir)
    {
        $id_wilayah = $kwartir;
        $data = $this->getData($id_wilayah);
        $title = $data[0]->name ?? 'Nasional';
        $kwartir = $data[1];
        $data = $data[0];
        return view('admin.kwartir.edit', compact('id_wilayah', 'title', 'kwartir', 'data'));
    }

    public function update(Request $request, $kwartir)
    {
        $data = $this->getData($kwartir);
        $kwartir = $data[1];
        $data1 = $data[0];
        if($data1->code != $request->code){
            if ($kwartir=='Provinsi') {
                $offset = 0;
            }elseif($kwartir=='Kabupaten'){
                $offset = 3;
            }elseif($kwartir=='Kecamatan'){
                $offset = 6;
            }

            foreach ($data1->anggota->chunk(1000) as $anggota) {
                dispatch(new UpdateCode($anggota, $request->code, $offset));
                // foreach ($anggota as $key => $value) {
                //     $value->kode = substr_replace($value->kode, $request->code, $offset, 2);
                //     $value->save();
                // }
            }
        }
        $data1->update($request->all());
        // $exitCode = Artisan::call('queue:work', []);
        return redirect()->route('kwartir.index', ['id_wilayah'=>$data[0]->prev]);
    }

    public function anggota($id_wilayah)
    {
        $data = $this->getData($id_wilayah);
        $title = $data[0]->name ?? 'Nasional';
        $kwartir = $data[1];
        return view('admin.kwartir.anggota', compact('id_wilayah', 'title', 'kwartir'));
    }

    public function getData($id_wilayah)
    {
        if ($id_wilayah=='all') {
            return [null,null];
        }
        $len = strlen($id_wilayah);
        if ($len==2) {
            $data = Provinsi::find($id_wilayah, ['name', 'id', 'no_prov as code', 'id as prev']);
            $kwartir = 'Provinsi';
        }elseif($len==4){
            $data = City::find($id_wilayah, ['name', 'id', 'no_kab as code', 'province_id as prev']);
            $kwartir = 'Kabupaten';
        }else{
            $data = Distrik::find($id_wilayah, ['name', 'id', 'no_kec as code', 'regency_id as prev']);
            $kwartir = 'Kecamatan';
        }

        return [$data, $kwartir];
    }

    public function data_table()
    {
        $id_wilayah = request('id_wilayah');
        if($id_wilayah=='all'){
            $data = Provinsi::select('id', 'name', 'no_prov as code', 'id as prev')->withCount(['anggota as admin' => function($q){
                $q->whereHas('user', function($q){
                    $q->where('role', 'kwarda');
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
                $data = City::where('province_id',$id_wilayah)->select('id','name','no_kab as code')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'kwarcab');
                    });
                },
                'anggota as anggota' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'anggota');
                    });
                }]);
                $type = 2;
            }elseif($len==4){
                $data =  Distrik::where('regency_id',$id_wilayah)->select('id','name','no_kec as code')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'kwaran');
                    });
                },
                'anggota as anggota' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'anggota');
                    });
                }]);
                $type = 3;
            }else{
                $data = Gudep::where('kecamatan',$id_wilayah)->select('id','nama_sekolah as name','npsn as code')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },
                'anggota as anggota' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'anggota');
                    });
                }]);
                $type = 4;
            }
        }

        return DataTables::of($data)
            ->addColumn('action', function ($data) use ($type) {
                if($type==4){
                    $html = '<div class="btn-group">
                                <a href="" class="btn btn-sm btn-primary">Detail Gudep</a>
                                <button type="button" onclick="showAdmin('.$data->id.',\'gudep\')" class="btn btn-sm btn-info">Lihat Admin</button>
                            </div>';
                }else{
                    $html = '<div class="btn-group">
                                <a href="'.route('kwartir.index', ['id_wilayah'=>$data->id]).'" class="btn btn-sm btn-primary">Lihat Wilayah</a>
                                <button type="button" onclick="showAdmin('.$data->id.')" class="btn btn-sm btn-info">Lihat Admin</button>
                                <a href="'.route('kwartir.anggota',$data->id).'" class="btn btn-sm btn-success">Tambah Admin</a>
                                <a href="'.route('statistik.index',['id_wilayah'=>$data->id]).'" class="btn btn-sm btn-warning">Lihat Statistik</a>
                            </div>';
                }
                return $html;
            })
            ->addColumn('tools', function ($data) use ($type) {
                if($type==4){
                    $html = '<a class="dropdown-item" href="">
                                <i class="fa fa-pencil-alt me-1"></i> Edit Gudep
                            </a>';
                }else{
                    $html = '<a class="dropdown-item" href="'.route('kwartir.edit',$data->id).'">
                                <i class="fa fa-pencil-alt me-1"></i> Edit Wilayah
                            </a>';
                }
                return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                '.$html.'
                            </div>
                        </div>';
            })
            ->rawColumns(['action','tools'])
            ->make(true);
    }

    public function data_table_anggota()
    {
        $id_wilayah = request('id_wilayah');
        if($id_wilayah=='all'){
            $data = Provinsi::select('id','name','no_prov as code');
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $data = Anggota::where('provinsi',$id_wilayah)->select('id','nama','email','foto')->whereHas('user', function($q){
                    $q->where('role','anggota');
                });
                $wilayah = Provinsi::find($id_wilayah)->name;
            }elseif($len==4){
                $data =  Anggota::where('kabupaten',$id_wilayah)->select('id','nama','email','foto')->whereHas('user', function($q){
                    $q->where('role','anggota');
                });
                $wilayah = City::find($id_wilayah)->name;
            }else{
                $data = Anggota::where('kecamatan',$id_wilayah)->select('id','nama','email','foto')->whereHas('user', function($q){
                    $q->where('role','anggota');
                });
                $wilayah = Distrik::find($id_wilayah)->name;
            }
        }

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $html = '<div class="btn-group">
                            <a href="#" class="btn btn-sm btn-primary">Detail Anggota</a>
                            <button type="button" onclick="addAdmin('.$data->id.')" class="btn btn-sm btn-success">Tambah Sebagai Admin</button>
                        </div>';
                return $html;
            })
            ->rawColumns(['action','foto'])
            ->make(true);
    }
}

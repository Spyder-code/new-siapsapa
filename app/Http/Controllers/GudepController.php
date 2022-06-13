<?php

namespace App\Http\Controllers;

use App\Models\Gudep;
use App\Models\Provinsi;
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

    public function store()
    {
        Gudep::create(request()->all());
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
                },
                'anggota as anggota' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'anggota');
                    });
                }]);
                $type = 2;
            }elseif($len==4){
                $data =  Gudep::where('kabupaten',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },
                'anggota as anggota' => function($q){
                    $q->whereHas('user', function($q){
                        $q->where('role', 'anggota');
                    });
                }]);
                $type = 3;
            }else{
                $data = Gudep::where('kecamatan',$id_wilayah)->select('id', 'nama_sekolah', 'npsn')->withCount(['anggota as admin' => function($q){
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
            ->addColumn('action', function ($data) {
                $html = '<div class="btn-group">
                                <a href="" class="btn btn-sm btn-primary">Detail Gudep</a>
                                <button type="button" onclick="showAdmin('.$data->id.',\'gudep\')" class="btn btn-sm btn-info">Lihat Admin</button>
                            </div>';
                return $html;
            })
            ->addColumn('tools', function ($data) {
                $html = '<a class="dropdown-item" href="">
                                <i class="fa fa-pencil-alt me-1"></i> Edit Gudep
                            </a>';
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
}

<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Distrik;
use App\Models\Gudep;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DataTableController extends Controller
{
    public function kwartir()
    {
        $id_wilayah = request('id_wilayah');
        $limit = request('length');
        $start = request('start') * request('length');
        if($id_wilayah=='all'){
            $data = Provinsi::select('id', 'name', 'no_prov as code', 'id as prev')->withCount(['anggota as admin' => function($q){
                $q->where('status', 1);
                $q->whereHas('user', function($q){
                    $q->where('role', 'kwarda');
                });
            },
            'anggota as anggota' => function($q){
                $q->where('status', 1);
            }])->offset($start)->limit($limit);
            $count =  Provinsi::select('id')->count();
            $type = 1;
            $len = 1;
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $data = City::where('province_id',$id_wilayah)->select('id','name','no_kab as code')->withCount(['anggota as admin' => function($q){
                    $q->where('status', 1);
                    $q->whereHas('user', function($q){
                        $q->where('role', 'kwarcab');
                    });
                },
                'anggota as anggota' => function($q){
                    $q->where('status', 1);
                }])->offset($start)->limit($limit);
                $count = City::where('province_id',$id_wilayah)->select('id')->count();
                $type = 2;
            }elseif($len==4){
                $data =  Distrik::where('regency_id',$id_wilayah)->select('id','name','no_kec as code')->withCount(['anggota as admin' => function($q){
                    $q->where('status', 1);
                    $q->whereHas('user', function($q){
                        $q->where('role', 'kwaran');
                    });
                },
                'anggota as anggota' => function($q){
                    $q->where('status', 1);
                }])->offset($start)->limit($limit);
                $count = Distrik::where('regency_id',$id_wilayah)->select('id')->count();
                $type = 3;
            }else{
                $data = Gudep::where('kecamatan',$id_wilayah)->select('id','nama_sekolah','npsn')->withCount(['anggota as admin' => function($q){
                    $q->where('status', 1);
                    $q->whereHas('user', function($q){
                        $q->where('role', 'gudep');
                    });
                },
                'anggota as anggota' => function($q){
                    $q->where('status', 1);
                }])->offset($start)->limit($limit);
                $count = Gudep::where('kecamatan',$id_wilayah)->select('id')->count();
                $type = 4;
            }
        }

        return DataTables::of($data)
            ->addColumn('action', function ($data) use ($type) {
                $g = '';
                if($type!=4){
                    $g = '<a href="'.route('page.statistik', ['id_wilayah'=>$data->id]).'" class="btn text-white btn-sm btn-primary">Lihat Wilayah</a>';
                }
                $html = '<div class="btn-group">
                            '.$g.'
                            <a href="'.route('statistik.index',['id_wilayah'=>$data->id]).'" class="btn text-white btn-sm btn-warning">Lihat Statistik</a>
                        </div>';
                return $html;
            })
            ->setFilteredRecords($count)
            ->rawColumns(['action'])
            ->make(true);
    }
}

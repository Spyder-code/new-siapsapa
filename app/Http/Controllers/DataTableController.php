<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Distrik;
use App\Models\Gudep;
use App\Models\Juri;
use App\Models\PanitiaAgenda;
use App\Models\Provinsi;
use App\Models\Transaction;
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
            $role = 'admin';
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
                $role = 'admin';
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
                $role = 'admin';
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
                $role = 'gudep';
            }
        }

        return DataTables::of($data)
            ->addColumn('action', function ($data) use ($type, $role) {
                $g = '';
                if($type!=4){
                    $g = '<a href="'.route('page.statistik', ['id_wilayah'=>$data->id]).'" class="btn text-white btn-sm btn-primary">Lihat Wilayah</a>';
                }
                $html = '<div class="btn-group">
                            '.$g.'
                            <a href="'.route('page.statistik.detail',['id_wilayah'=>$data->id,'role'=>$role]).'" class="btn text-white btn-sm btn-warning">Lihat Statistik</a>
                        </div>';
                return $html;
            })
            ->setFilteredRecords($count)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function juri()
    {
        $limit = request('length');
        $start = request('start') * request('length');
        $data = Transaction::join('transaction_details','transaction_details.id','=','transactions.transaction_detail_id')
            ->join('tb_anggota','tb_anggota.id','=','transactions.anggota_id')
            ->select('tb_anggota.*','transactions.transaction_detail_id','transactions.anggota_id')
            ->where('transaction_details.payment_status','<',4)
            ->where('tb_anggota.status',1)
            ->offset($start)->limit($limit);
        $count = Transaction::join('transaction_details','transaction_details.id','=','transactions.transaction_detail_id')
        ->join('tb_anggota','tb_anggota.id','=','transactions.anggota_id')
        ->select('tb_anggota.*','transactions.transaction_detail_id','transactions.anggota_id')
        ->where('transaction_details.payment_status','<',4)
        ->where('tb_anggota.status',1)->count();

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
                }elseif($data->pramuka==6){
                    $warna = '<span class="badge bg-dewasa">Pembina</span>';
                }elseif($data->pramuka==7){
                    $warna = '<span class="badge bg-dewasa">Pelatih</span>';
                }elseif($data->pramuka==8){
                    $warna = '<span class="badge bg-dewasa">Saka</span>';
                }else{
                    $warna = '<span class="badge bg-white text-dark">-</span>';
                }
                if ($data->cetak) {
                    if($data->cetak->transactionDetail->payment_statu<4){
                        $warna.='<br><span class="text-success" style=" position:relative; font-size:1.4rem"><i class="fas fa-check-circle"></i></span>';
                    }
                }
                return '
                    <div class="justify-content-center text-center">
                    <img src="'.asset('berkas/anggota/'.$data->foto).'" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                        '.$warna.'
                    </div>
                ';
            })
            ->addColumn('action', function ($data) {
                $html = '<button class="btn btn-sm btn-outline-success" onclick="addJuri('.$data->id.')" style="font-size:.7rem">Jadikan Juri</button>';
                return $html;
            })
            ->setFilteredRecords($count)
            ->rawColumns(['action','foto'])
            ->make(true);
    }

    public function panitia()
    {
        $limit = request('length');
        $start = request('start') * request('length');
        $data = Transaction::join('transaction_details','transaction_details.id','=','transactions.transaction_detail_id')
            ->join('tb_anggota','tb_anggota.id','=','transactions.anggota_id')
            ->select('tb_anggota.*','transactions.transaction_detail_id','transactions.anggota_id')
            ->where('transaction_details.payment_status','<',4)
            ->where('tb_anggota.status',1)
            ->offset($start)->limit($limit);
        $count = Transaction::join('transaction_details','transaction_details.id','=','transactions.transaction_detail_id')
        ->join('tb_anggota','tb_anggota.id','=','transactions.anggota_id')
        ->select('tb_anggota.*','transactions.transaction_detail_id','transactions.anggota_id')
        ->where('transaction_details.payment_status','<',4)
        ->where('tb_anggota.status',1)->count();

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
                }elseif($data->pramuka==6){
                    $warna = '<span class="badge bg-dewasa">Pembina</span>';
                }elseif($data->pramuka==7){
                    $warna = '<span class="badge bg-dewasa">Pelatih</span>';
                }elseif($data->pramuka==8){
                    $warna = '<span class="badge bg-dewasa">Saka</span>';
                }else{
                    $warna = '<span class="badge bg-white text-dark">-</span>';
                }
                if ($data->cetak) {
                    if($data->cetak->transactionDetail->payment_statu<4){
                        $warna.='<br><span class="text-success" style=" position:relative; font-size:1.4rem"><i class="fas fa-check-circle"></i></span>';
                    }
                }
                return '
                    <div class="justify-content-center text-center">
                    <img src="'.asset('berkas/anggota/'.$data->foto).'" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                        '.$warna.'
                    </div>
                ';
            })
            ->addColumn('action', function ($data) {
                $cek = PanitiaAgenda::where('anggota_id',$data->id)->first();
                $html = '';
                if(!$cek){
                    $html = '<button class="btn btn-sm btn-outline-success" onclick="addPanitia('.$data->id.')" style="font-size:.7rem">Jadikan Panitia</button>';
                }
                return $html;
            })
            ->setFilteredRecords($count)
            ->rawColumns(['action','foto'])
            ->make(true);
    }
}

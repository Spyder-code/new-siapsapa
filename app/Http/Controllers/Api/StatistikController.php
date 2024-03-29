<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\DocumentType;
use App\Models\Organizations;
use App\Models\Pramuka;
use App\Models\Provinsi;
use App\Models\User;
use App\Repositories\StatistikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
{

    public function getNumberOfMemberAndAdmin($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        if(request('gudep')){
            $data = $statistik->getNumberOfMemberAndAdmin(request('gudep'));
        }else{
            $data = $statistik->getNumberOfMemberAndAdmin();
        }
        return response()->json($data);
    }
    public function getNumberOfPramuka($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        if(request('gudep')){
            $data = $statistik->getNumberOfPramuka(request('gudep'));
        }else{
            $data = $statistik->getNumberOfPramuka();
        }
        return response()->json($data);
    }
    public function getNumberOfPramukaGudep($gudep)
    {
        $statistik = new StatistikService();
        $data = $statistik->getNumberOfPramukaGudep($gudep);
        return response()->json($data);
    }

    public function getGender($id_wilayah)
    {
        try {
            if(request('gudep')){
                $statistik = new StatistikService($id_wilayah, request('gudep'));
            }else{
                $statistik = new StatistikService($id_wilayah);
            }
            if(request('golongan')){
                $data = $statistik->getGender(true);
            }else{
                $data = $statistik->getGender();
            }
            return response()->json($data);
        } catch (\Throwable $th) {
            return response($th);
        }
    }

    public function getAnggotaActiveAndUnactive($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        $data = $statistik->getAnggotaActiveAndUnactive();
        return response()->json($data);
    }

    public function getAnggotaGudepAndNonGudep($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        $data = $statistik->getAnggotaGudepAndNonGudep();
        return response()->json($data);
    }

    public function getNumberOfTitle($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        $data = $statistik->getNumberOfTitle();
        return response()->json($data);
    }

    public function dashboard($id_wilayah)
    {
        if(request('gudep')){
            $statistik = new StatistikService($id_wilayah, request('gudep'));
        }else{
            $statistik = new StatistikService($id_wilayah);
        }
        $data = $statistik->dashboard();
        return response()->json($data);
    }

    public function statistikAnggota($id_wilayah)
    {
        if(request('gudep')){
            $statistik = new StatistikService($id_wilayah, request('gudep'));
        }else{
            $statistik = new StatistikService($id_wilayah);
        }
        $data = $statistik->statistikAnggota();
        return response()->json($data);
    }

    public function statistikDarah($id_wilayah)
    {
        if(request('gudep')){
            $statistik = new StatistikService($id_wilayah, request('gudep'));
        }else{
            $statistik = new StatistikService($id_wilayah);
        }
        $data = $statistik->statistikDarah();
        return response()->json($data);
    }

    public function statistikAgama($id_wilayah)
    {
        if(request('gudep')){
            $statistik = new StatistikService($id_wilayah, request('gudep'));
        }else{
            $statistik = new StatistikService($id_wilayah);
        }
        $data = $statistik->statistikAgama();
        return response()->json($data);
    }

    public function statistikTingkat($id_wilayah)
    {
        if(request('gudep')){
            $statistik = new StatistikService($id_wilayah, request('gudep'));
        }else{
            $statistik = new StatistikService($id_wilayah);
        }
        $data = $statistik->statistikTingkat();
        return response()->json($data);
    }

    public function jumlahAnggota($id_wilayah)
    {
        if(request('gudep')){
            $statistik = new StatistikService($id_wilayah, request('gudep'));
        }else{
            $statistik = new StatistikService($id_wilayah);
        }
        $data = $statistik->jumlahAnggota();
        return response()->json($data);
    }

    public function anggotaMuda()
    {
        $data = Pramuka::whereIn('id',[1,2,3,4,6,7])->get();
        $tr = '';
        $id_wilayah = request('id_wilayah');
        if($id_wilayah=='all'){
            $role = 0;
        }else{
            if(request('role') && request('role')=='gudep'){
                $role = 'gudep';
            }else{
                $role = strlen($id_wilayah);
            }
        }
        foreach ($data as $pramuka){
            foreach ($pramuka->documentTypes as $idx => $item){
                $url = route('anggota.search_document',['id'=>$item->id,'id_wilayah'=>$id_wilayah]);
                if ($role==0) {
                    $lkk = $pramuka->anggotas()->where('status',1)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('status',1)->where('jk','P')->count();
                    $plk =  $pramuka->anggotas()->where('status',1)->where('pramuka',5)->where('jk','L')->count();
                    $ppr =  $pramuka->anggotas()->where('status',1)->where('pramuka',5)->where('jk','P')->count();
                    // $count = $item->documents()->whereHas('user', function($q) use($item){
                    //     $q->whereHas('anggota', function($q) use($item){
                    //         $q->where('tingkat',$item->id);
                    //     });
                    // })->count();
                    // $lk = $item->documents()->whereHas('user', function($q) use($item){
                    //     $q->whereHas('anggota', function($q) use($item){
                    //         $q->where('jk', 'L');
                    //         $q->where('tingkat',$item->id);
                    //     });
                    // })->count();
                    // $pr = $item->documents()->whereHas('user', function($q) use($item){
                    //     $q->whereHas('anggota', function($q) use($item){
                    //         $q->where('jk', 'P');
                    //         $q->where('tingkat',$item->id);
                    //     });
                    // })->count();
                    $count =  $pramuka->anggotas()->where('tingkat',$item->id)->count();
                    $pr =  $pramuka->anggotas()->where('tingkat',$item->id)->where('jk','P')->count();
                    $lk =  $pramuka->anggotas()->where('tingkat',$item->id)->where('jk','L')->count();
                }elseif($role==2){
                    $lkk = $pramuka->anggotas()->where('status',1)->where('provinsi',$id_wilayah)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('status',1)->where('provinsi',$id_wilayah)->where('jk','P')->count();
                    $plk = $pramuka->anggotas()->where('provinsi',$id_wilayah)->where('status',1)->where('pramuka',5)->where('jk','L')->count();
                    $ppr = $pramuka->anggotas()->where('provinsi',$id_wilayah)->where('status',1)->where('pramuka',5)->where('jk','P')->count();
                    // $count = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('provinsi',$id_wilayah);
                    //         $q->where('tingkat',$item->id);
                    //     });
                    // })->count();
                    // $lk = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('jk', 'L');
                    //         $q->where('tingkat',$item->id);
                    //         $q->where('provinsi',$id_wilayah);
                    //     });
                    // })->count();
                    // $pr = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('jk', 'P');
                    //         $q->where('tingkat',$item->id);
                    //         $q->where('provinsi',$id_wilayah);
                    //     });
                    // })->count();
                    $count = $pramuka->anggotas()->where('status',1)->where('tingkat',$item->id)->where('provinsi',$id_wilayah)->count();
                    $pr = $pramuka->anggotas()->where('status',1)->where('tingkat',$item->id)->where('jk','P')->where('provinsi',$id_wilayah)->count();
                    $lk = $pramuka->anggotas()->where('status',1)->where('tingkat',$item->id)->where('jk','L')->where('provinsi',$id_wilayah)->count();
                }elseif($role==4){
                    $lkk = $pramuka->anggotas()->where('status',1)->where('kabupaten',$id_wilayah)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('status',1)->where('kabupaten',$id_wilayah)->where('jk','P')->count();
                    $plk =  $pramuka->anggotas()->where('kabupaten',$id_wilayah)->where('status',1)->where('pramuka',5)->where('jk','L')->count();
                    $ppr =  $pramuka->anggotas()->where('kabupaten',$id_wilayah)->where('status',1)->where('pramuka',5)->where('jk','P')->count();
                    // $count = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('kabupaten',$id_wilayah);
                    //         $q->where('tingkat',$item->id);
                    //     });
                    // })->count();
                    // $lk = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('jk', 'L');
                    //         $q->where('tingkat',$item->id);
                    //         $q->where('kabupaten',$id_wilayah);
                    //     });
                    // })->count();
                    // $pr = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('jk', 'P');
                    //         $q->where('tingkat',$item->id);
                    //         $q->where('kabupaten',$id_wilayah);
                    //     });
                    // })->count();
                    $count =  $pramuka->anggotas()->where('tingkat',$item->id)->where('kabupaten',$id_wilayah)->count();
                    $pr =  $pramuka->anggotas()->where('tingkat',$item->id)->where('jk','P')->where('kabupaten',$id_wilayah)->count();
                    $lk =  $pramuka->anggotas()->where('tingkat',$item->id)->where('jk','L')->where('kabupaten',$id_wilayah)->count();
                }elseif($role==7){
                    $lkk = $pramuka->anggotas()->where('status',1)->where('kecamatan',$id_wilayah)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('status',1)->where('kecamatan',$id_wilayah)->where('jk','P')->count();
                    $plk =  $pramuka->anggotas()->where('kecamatan',$id_wilayah)->where('status',1)->where('pramuka',5)->where('jk','L')->count();
                    $ppr =  $pramuka->anggotas()->where('kecamatan',$id_wilayah)->where('status',1)->where('pramuka',5)->where('jk','P')->count();
                    // $count = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('kecamatan',$id_wilayah);
                    //         $q->where('tingkat',$item->id);
                    //     });
                    // })->count();
                    // $lk = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('jk', 'L');
                    //         $q->where('tingkat',$item->id);
                    //         $q->where('kecamatan',$id_wilayah);
                    //     });
                    // })->count();
                    // $pr = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('jk', 'P');
                    //         $q->where('tingkat',$item->id);
                    //         $q->where('kecamatan',$id_wilayah);
                    //     });
                    // })->count();
                    $count =  $pramuka->anggotas()->where('tingkat',$item->id)->where('kecamatan',$id_wilayah)->count();
                    $pr =  $pramuka->anggotas()->where('tingkat',$item->id)->where('jk','P')->where('kecamatan',$id_wilayah)->count();
                    $lk =  $pramuka->anggotas()->where('tingkat',$item->id)->where('jk','L')->where('kecamatan',$id_wilayah)->count();
                }elseif($role=='gudep'){
                    $lkk = $pramuka->anggotas()->where('status',1)->where('gudep',$id_wilayah)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('status',1)->where('gudep',$id_wilayah)->where('jk','P')->count();
                    $plk = $pramuka->anggotas()->where('gudep',$id_wilayah)->where('status',1)->where('pramuka',5)->where('jk','L')->count();
                    $ppr = $pramuka->anggotas()->where('gudep',$id_wilayah)->where('status',1)->where('pramuka',5)->where('jk','P')->count();
                    // $count = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('gudep',$id_wilayah);
                    //         $q->where('tingkat',$item->id);
                    //     });
                    // })->count();
                    // $lk = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('jk', 'L');
                    //         $q->where('tingkat',$item->id);
                    //         $q->where('gudep',$id_wilayah);
                    //     });
                    // })->count();
                    // $pr = $item->documents()->whereHas('user', function($q) use($id_wilayah,$item){
                    //     $q->whereHas('anggota', function($q) use($id_wilayah,$item){
                    //         $q->where('jk', 'P');
                    //         $q->where('tingkat',$item->id);
                    //         $q->where('gudep',$id_wilayah);
                    //     });
                    // })->count();
                    $count = $pramuka->anggotas()->where('tingkat',$item->id)->where('gudep',$id_wilayah)->count();
                    $pr = $pramuka->anggotas()->where('tingkat',$item->id)->where('jk','P')->where('gudep',$id_wilayah)->count();
                    $lk = $pramuka->anggotas()->where('tingkat',$item->id)->where('jk','L')->where('gudep',$id_wilayah)->count();
                    $url = route('anggota.search_document',['id'=>$item->id,'id_wilayah'=>$id_wilayah,'role'=>'gudep']);
                }
                if ($idx==0) {
                    $first = '<td scope="row" class="table-'.strtolower($pramuka->name).'" rowspan="'.$pramuka->documentTypes->count().'">
                        '.$pramuka->name.' <br><br>
                        <span class="fw-normal" style="font-size: .7rem">L: '.$lkk.'</span><br>
                        <span class="fw-normal" style="font-size: .7rem">P: '.$prr.'</span><br>
                        <span class="fw-normal" style="font-size: .7rem">J: '.$prr+$lkk.'</span>
                    </td>';
                }else{
                    $first = '';
                }
                $tr = $tr.'<tr>
                '.$first.'
                <td>'.$item->name.'</td>
                <td>'.(int)$lk.'</td>
                <td>'.(int)$pr.'</td>
                <td>'.(int)$count.'</td>
                <td><a href="'.$url.'" class="btn btn-sm btn-info">Detail</a></td>
            </tr>';
            }
        }
        $response = '<table class="table text-center table-bordered text-dark" id="tableGolongan">
                        <thead>
                            <tr>
                                <th class="table-secondary" scope="col" colspan="2">Golongan</th>
                                <th class="table-secondary" scope="col">Laki-laki</th>
                                <th class="table-secondary" scope="col">Perempuan</th>
                                <th class="table-secondary" scope="col">Jumlah</th>
                                <th class="table-secondary" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        '.$tr.'
                        <tr>
                            <td scope="row">
                                Pembantu
                            </td>
                            <td>-</td>
                            <td>'.$plk.'</td>
                            <td>'. $ppr .'</td>
                            <td>'. $ppr+$plk .'</td>
                            <td>-</td>
                        </tr>
                        </tbody>
                    </table>';
        return response($response);

    }
    public function anggotaSaka()
    {
        $tr = '';
        $id_wilayah = request('id_wilayah');
        if($id_wilayah=='all'){
            $role = 0;
        }else{
            if(request('role') && request('role')=='gudep'){
                $role = 'gudep';
            }else{
                $role = strlen($id_wilayah);
            }
        }
        $saka = DocumentType::where('pramuka_id',8)->get();
        foreach ($saka as $item){
            if($role==0){
                $lk = $item->documents()->whereHas('user', function($q){
                    $q->whereHas('anggota', function($q){
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q){
                    $q->whereHas('anggota', function($q){
                        $q->where('jk', 'P');
                    });
                })->count();
            }elseif($role==2){
                $lk = $item->documents()->whereHas('user', function($q) use($id_wilayah){
                    $q->whereHas('anggota', function($q) use($id_wilayah){
                        $q->where('provinsi', $id_wilayah);
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q) use($id_wilayah){
                    $q->whereHas('anggota', function($q) use($id_wilayah){
                        $q->where('provinsi', $id_wilayah);
                        $q->where('jk', 'P');
                    });
                })->count();
            }elseif($role==4){
                $lk = $item->documents()->whereHas('user', function($q) use($id_wilayah){
                    $q->whereHas('anggota', function($q) use($id_wilayah){
                        $q->where('kabupaten', $id_wilayah);
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q) use($id_wilayah){
                    $q->whereHas('anggota', function($q) use($id_wilayah){
                        $q->where('kabupaten', $id_wilayah);
                        $q->where('jk', 'P');
                    });
                })->count();
            }elseif($role==7){
                $lk = $item->documents()->whereHas('user', function($q) use($id_wilayah){
                    $q->whereHas('anggota', function($q) use($id_wilayah){
                        $q->where('kecamatan', $id_wilayah);
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q) use($id_wilayah){
                    $q->whereHas('anggota', function($q) use($id_wilayah){
                        $q->where('kecamatan', $id_wilayah);
                        $q->where('jk', 'P');
                    });
                })->count();
            }elseif($role=='gudep'){
                $lk = $item->documents()->whereHas('user', function($q) use($id_wilayah){
                    $q->whereHas('anggota', function($q) use($id_wilayah){
                        $q->where('gudep', $id_wilayah);
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q) use($id_wilayah){
                    $q->whereHas('anggota', function($q) use($id_wilayah){
                        $q->where('gudep', $id_wilayah);
                        $q->where('jk', 'P');
                    });
                })->count();
            }
            $tr = $tr.'<tr>
                <td>'.$item->name.'</td>
                <td>'.$lk.'</td>
                <td>'.$pr.'</td>
                <td> '.$item->documents->count().'</td>
                <td><a href="'.route('anggota.search_document',['id'=>$item->id,'id_wilayah'=>$id_wilayah]).'" class="btn btn-sm btn-info">Detail</a></td>
            </tr>';
        }

        $response = '<table class="table text-center table-bordered text-dark" id="tableSaka">
            <thead>
                <tr>
                    <th class="table-secondary" scope="col">Golongan</th>
                    <th class="table-secondary" scope="col">Laki-laki</th>
                    <th class="table-secondary" scope="col">Perempuan</th>
                    <th class="table-secondary" scope="col">Jumlah</th>
                    <th class="table-secondary" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                '.$tr.'
            </tbody>
        </table>';
        return response($response);
    }

    public function fungsionaris()
    {
        $organizations = Organizations::all();
        $res = '';
        $id_wilayah = request('id_wilayah');
        if($id_wilayah=='all'){
            $role = 0;
        }else{
            if(request('role') && request('role')=='gudep'){
                $role = 'gudep';
            }else{
                $role = strlen($id_wilayah);
            }
        }
        foreach ($organizations as $item){
            if ($role==0) {
                $count = $item->organizationUsers()->count();
            }elseif($role==2){
                $count = $item->organizationUsers()->whereHas('anggota', function($q) use($id_wilayah){
                    $q->where('provinsi',$id_wilayah);
                })->count();
            }elseif($role==4){
                $count = $item->organizationUsers()->whereHas('anggota', function($q) use($id_wilayah){
                    $q->where('kabupaten',$id_wilayah);
                })->count();
            }elseif($role==7){
                $count = $item->organizationUsers()->whereHas('anggota', function($q) use($id_wilayah){
                    $q->where('kecamatan',$id_wilayah);
                })->count();
            }elseif($role=='gudep'){
                $count = $item->organizationUsers()->whereHas('anggota', function($q) use($id_wilayah){
                    $q->where('gudep',$id_wilayah);
                })->count();
            }
            $res = $res.'
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">'.$item->name.'</li>
                <li class="list-group-item">'.$count.'</li>
            </ul>';
        }

        return response($res);
    }
}

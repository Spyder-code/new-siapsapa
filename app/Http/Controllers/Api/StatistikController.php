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
        $user = User::find(request('user_id'));
        $role = $user->role;
        foreach ($data as $pramuka){
            foreach ($pramuka->documentTypes as $idx => $item){
                if ($role=='admin') {
                    $lkk = $pramuka->anggotas()->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('jk','P')->count();
                    $count = $item->documents->count();
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
                }elseif($role=='kwarda'){
                    $lkk = $pramuka->anggotas()->where('provinsi',$user->anggota->provinsi)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('provinsi',$user->anggota->provinsi)->where('jk','P')->count();
                    $count = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('provinsi',$user->anggota->provinsi);
                        });
                    })->count();
                    $lk = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('jk', 'L');
                            $q->where('provinsi',$user->anggota->provinsi);
                        });
                    })->count();
                    $pr = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('jk', 'P');
                            $q->where('provinsi',$user->anggota->provinsi);
                        });
                    })->count();
                }elseif($role=='kwarcab'){
                    $lkk = $pramuka->anggotas()->where('kabupaten',$user->anggota->kabupaten)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('kabupaten',$user->anggota->kabupaten)->where('jk','P')->count();
                    $count = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('kabupaten',$user->anggota->kabupaten);
                        });
                    })->count();
                    $lk = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('jk', 'L');
                            $q->where('kabupaten',$user->anggota->kabupaten);
                        });
                    })->count();
                    $pr = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('jk', 'P');
                            $q->where('kabupaten',$user->anggota->kabupaten);
                        });
                    })->count();
                }elseif($role=='kwaran'){
                    $lkk = $pramuka->anggotas()->where('kecamatan',$user->anggota->kecamatan)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('kecamatan',$user->anggota->kecamatan)->where('jk','P')->count();
                    $count = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('kecamatan',$user->anggota->kecamatan);
                        });
                    })->count();
                    $lk = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('jk', 'L');
                            $q->where('kecamatan',$user->anggota->kecamatan);
                        });
                    })->count();
                    $pr = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('jk', 'P');
                            $q->where('kecamatan',$user->anggota->kecamatan);
                        });
                    })->count();
                }elseif($role=='gudep'){
                    $lkk = $pramuka->anggotas()->where('gudep',$user->anggota->gudep)->where('jk','L')->count();
                    $prr = $pramuka->anggotas()->where('gudep',$user->anggota->gudep)->where('jk','P')->count();
                    $count = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('gudep',$user->anggota->gudep);
                        });
                    })->count();
                    $lk = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('jk', 'L');
                            $q->where('gudep',$user->anggota->gudep);
                        });
                    })->count();
                    $pr = $item->documents()->whereHas('user', function($q) use($user){
                        $q->whereHas('anggota', function($q) use($user){
                            $q->where('jk', 'P');
                            $q->where('gudep',$user->anggota->gudep);
                        });
                    })->count();
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
                <td><a href="'.route('anggota.search_document',$item->id).'" class="btn btn-sm btn-info">Detail</a></td>
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
                        </tbody>
                    </table>';
        return response($response);

    }

    public function anggotaSaka()
    {
        $tr = '';
        $user = User::find(request('user_id'));
        $role = $user->role;
        $saka = DocumentType::where('pramuka_id',8)->get();
        foreach ($saka as $item){
            if($role=='admin'){
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
            }elseif($role=='kwarda'){
                $lk = $item->documents()->whereHas('user', function($q) use($user){
                    $q->whereHas('anggota', function($q) use($user){
                        $q->where('provinsi', $user->anggota->provinsi);
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q) use($user){
                    $q->whereHas('anggota', function($q) use($user){
                        $q->where('provinsi', $user->anggota->provinsi);
                        $q->where('jk', 'P');
                    });
                })->count();
            }elseif($role=='kwarcab'){
                $lk = $item->documents()->whereHas('user', function($q) use($user){
                    $q->whereHas('anggota', function($q) use($user){
                        $q->where('kabupaten', $user->anggota->kabupaten);
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q) use($user){
                    $q->whereHas('anggota', function($q) use($user){
                        $q->where('kabupaten', $user->anggota->kabupaten);
                        $q->where('jk', 'P');
                    });
                })->count();
            }elseif($role=='kwaran'){
                $lk = $item->documents()->whereHas('user', function($q) use($user){
                    $q->whereHas('anggota', function($q) use($user){
                        $q->where('kecamatan', $user->anggota->kecamatan);
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q) use($user){
                    $q->whereHas('anggota', function($q) use($user){
                        $q->where('kecamatan', $user->anggota->kecamatan);
                        $q->where('jk', 'P');
                    });
                })->count();
            }elseif($role=='gudep'){
                $lk = $item->documents()->whereHas('user', function($q) use($user){
                    $q->whereHas('anggota', function($q) use($user){
                        $q->where('gudep', $user->anggota->gudep);
                        $q->where('jk', 'L');
                    });
                })->count();
                $pr = $item->documents()->whereHas('user', function($q) use($user){
                    $q->whereHas('anggota', function($q) use($user){
                        $q->where('gudep', $user->anggota->gudep);
                        $q->where('jk', 'P');
                    });
                })->count();
            }
            $tr = $tr.'<tr>
                <td>'.$item->name.'</td>
                <td>'.$lk.'</td>
                <td>'.$pr.'</td>
                <td> '.$item->documents->count().'</td>
                <td><a href="'.route('anggota.search_document',$item->id).'" class="btn btn-sm btn-info">Detail</a></td>
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
        $user = User::find(request('user_id'));
        $role = $user->role;
        foreach ($organizations as $item){
            if ($role=='admin') {
                $count = $item->organizationUsers()->count();
            }elseif($role=='kwarda'){
                $count = $item->organizationUsers()->whereHas('anggota', function($q) use($user){
                    $q->where('provinsi',$user->anggota->provinsi);
                })->count();
            }elseif($role=='kwarcab'){
                $count = $item->organizationUsers()->whereHas('anggota', function($q) use($user){
                    $q->where('kabupaten',$user->anggota->kabupaten);
                })->count();
            }elseif($role=='kwaran'){
                $count = $item->organizationUsers()->whereHas('anggota', function($q) use($user){
                    $q->where('kecamatan',$user->anggota->kecamatan);
                })->count();
            }elseif($role=='gudep'){
                $count = $item->organizationUsers()->whereHas('anggota', function($q) use($user){
                    $q->where('gudep',$user->anggota->gudep);
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

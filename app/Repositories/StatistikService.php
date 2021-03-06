<?php namespace App\Repositories;

use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\DocumentType;
use App\Models\Provinsi;
use Carbon\Carbon;

class StatistikService {

    private $id_wilayah;
    private $gudep;
    public function __construct($id_wilayah, $gudep = null)
    {
        $this->gudep = $gudep;
        $this->id_wilayah = $id_wilayah;
    }

    public function getGender($golongan = false)
    {
        $id_wilayah = $this->id_wilayah;
        if($this->gudep==null){
            if($id_wilayah=='all'){
                $male = Anggota::where('status',1)->where('jk','Laki-Laki')->get();
                $female = Anggota::where('status',1)->where('jk','Perempuan')->get();
            }else{
                $len = strlen($id_wilayah);
                if ($len==2) {
                    $male = Anggota::where('status',1)->where('provinsi',$id_wilayah)->where('jk','Laki-Laki')->get();
                    $female = Anggota::where('status',1)->where('provinsi',$id_wilayah)->where('jk','Perempuan')->get();
                }elseif($len==4){
                    $male =  Anggota::where('status',1)->where('kabupaten',$id_wilayah)->where('jk','Laki-Laki')->get();
                    $female =  Anggota::where('status',1)->where('kabupaten',$id_wilayah)->where('jk','Perempuan')->get();
                }else{
                    $male =  Anggota::where('status',1)->where('kecamatan',$id_wilayah)->where('jk','Laki-Laki')->get();
                    $female =  Anggota::where('status',1)->where('kecamatan',$id_wilayah)->where('jk','Perempuan')->get();
                }
            }
        }else{
            $male =  Anggota::where('gudep', $this->gudep)->where('status',1)->where('jk','Laki-Laki')->get();
            $female =  Anggota::where('gudep', $this->gudep)->where('status',1)->where('jk','Perempuan')->get();
        }

        if ($golongan) {
            $siaga = [
                'male' => $male->where('pramuka',1)->count(),
                'female' => $female->where('pramuka',1)->count(),
            ];
            $penggalang = [
                'male' => $male->where('pramuka',2)->count(),
                'female' => $female->where('pramuka',2)->count(),
            ];
            $penegak = [
                'male' => $male->where('pramuka',3)->count(),
                'female' => $female->where('pramuka',3)->count(),
            ];
            $pandega = [
                'male' => $male->where('pramuka',4)->count(),
                'female' => $female->where('pramuka',4)->count(),
            ];
            $dewasa = [
                'male' => $male->where('pramuka',5)->count(),
                'female' => $female->where('pramuka',5)->count(),
            ];
            return [
                'siaga' => $siaga,
                'penggalang' => $penggalang,
                'penegak' => $penegak,
                'pandega' => $pandega,
                'dewasa' => $dewasa,
                'total_male' => $male->count(),
                'total_female' => $female->count(),
            ];
        }else{
            $male = $male->count();
            $female = $female->count();
            return [
                'male' => $male,
                'female' => $female
            ];
        }

    }

    public function getAnggotaActiveAndUnactive()
    {
        $id_wilayah = $this->id_wilayah;
        if($this->gudep==null){
            if($id_wilayah=='all'){
                $active = Anggota::where('status',1)->count();
                $unactive = Anggota::where('status',0)->count();
            }else{
                $len = strlen($id_wilayah);
                if ($len==2) {
                    $active = Anggota::where('provinsi',$id_wilayah)->where('status',1)->count();
                    $unactive = Anggota::where('provinsi',$id_wilayah)->where('status',0)->count();
                }elseif($len==4){
                    $active =  Anggota::where('kabupaten',$id_wilayah)->where('status',1)->count();
                    $unactive =  Anggota::where('kabupaten',$id_wilayah)->where('status',0)->count();
                }else{
                    $active =  Anggota::where('kecamatan',$id_wilayah)->where('status',1)->count();
                    $unactive =  Anggota::where('kecamatan',$id_wilayah)->where('status',0)->count();
                }
            }
        }else{
            $active = Anggota::where('gudep',$this->gudep)->where('status',1)->count();
            $unactive = Anggota::where('gudep',$this->gudep)->where('status',0)->count();
        }

        return [
            'active' => $active,
            'unactive' => $unactive
        ];
    }

    public function getAnggotaGudepAndNonGudep()
    {
        $id_wilayah = $this->id_wilayah;
        if($id_wilayah=='all'){
            $gudep = Anggota::where('status',1)->whereNotNull('gudep')->count();
            $non_gudep = Anggota::where('status',1)->whereNull('gudep')->count();
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $gudep = Anggota::where('status',1)->where('provinsi',$id_wilayah)->whereNotNull('gudep')->count();
                $non_gudep = Anggota::where('status',1)->where('provinsi',$id_wilayah)->whereNull('gudep')->count();
            }elseif($len==4){
                $gudep =  Anggota::where('status',1)->where('kabupaten',$id_wilayah)->whereNotNull('gudep')->count();
                $non_gudep =  Anggota::where('status',1)->where('kabupaten',$id_wilayah)->whereNull('gudep')->count();
            }else{
                $gudep =  Anggota::where('status',1)->where('kecamatan',$id_wilayah)->whereNotNull('gudep')->count();
                $non_gudep =  Anggota::where('status',1)->where('kecamatan',$id_wilayah)->whereNull('gudep')->count();
            }
        }

        return [
            'gudep' => $gudep,
            'non_gudep' => $non_gudep
        ];
    }

    public function getNumberOfPramuka($gudep = null)
    {
        $id_wilayah = $this->id_wilayah;
        if($gudep!=null){
            $anggota = Anggota::where('status',1)->where('gudep',$gudep)->get();
            $siaga = $anggota->where('pramuka',1)->count();
            $penggalang = $anggota->where('pramuka',2)->count();
            $penegak = $anggota->where('pramuka',3)->count();
            $pandega = $anggota->where('pramuka',4)->count();
            $dewasa = $anggota->where('pramuka',5)->count();
            $pelatih = $anggota->where('pramuka',6)->count();
        }else{
            if($id_wilayah=='all'){
                $siaga = Anggota::where('status',1)->where('pramuka',1)->count();
                $penggalang = Anggota::where('status',1)->where('pramuka',2)->count();
                $penegak = Anggota::where('status',1)->where('pramuka',3)->count();
                $pandega = Anggota::where('status',1)->where('pramuka',4)->count();
                $dewasa = Anggota::where('status',1)->where('pramuka',5)->count();
                $pelatih = Anggota::where('status',1)->where('pramuka',6)->count();
            }else{
                $len = strlen($id_wilayah);
                if ($len==2) {
                    $query = Anggota::where('status',1)->where('provinsi',$id_wilayah)->get();
                }elseif($len==4){
                    $query = Anggota::where('status',1)->where('kabupaten',$id_wilayah)->get();
                }else{
                    $query = Anggota::where('status',1)->where('kecamatan',$id_wilayah)->get();
                }

                $siaga = $query->where('pramuka',1)->count();
                $penggalang = $query->where('pramuka',2)->count();
                $penegak = $query->where('pramuka',3)->count();
                $pandega = $query->where('pramuka',4)->count();
                $dewasa = $query->where('pramuka',5)->count();
                $pelatih = $query->where('pramuka',6)->count();
            }
        }

        return [
            'siaga' => $siaga,
            'penggalang' => $penggalang,
            'penegak' => $penegak,
            'pandega' => $pandega,
            'dewasa' => $dewasa,
            'pelatih' => $pelatih,
            'total' => $siaga+$penggalang+$penegak+$pandega+$dewasa+$pelatih
        ];
    }

    public function getNumberOfAnggotaInYear($year = null)
    {
        if ($year==null) {
            $year = date('Y');
        }
        $id_wilayah = $this->id_wilayah;
        if($this->gudep==null){
            if($id_wilayah=='all'){
                $query = Anggota::where('status',1);
            }else{
                $len = strlen($id_wilayah);
                if ($len==2) {
                    $query = Anggota::where('status',1)->where('provinsi',$id_wilayah);
                }elseif($len==4){
                    $query =  Anggota::where('status',1)->where('kabupaten',$id_wilayah);
                }else{
                    $query =  Anggota::where('status',1)->where('kecamatan',$id_wilayah);
                }
            }
        }else{
            $query = Anggota::where('gudep', $this->gudep);
        }

        $anggota = $query->whereYear('created_at', $year)->get('created_at')->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $data = array();
        $label = array();
        foreach ($anggota as $item ) {
            array_push($data,$item->count());
            array_push($label,date('F',strtotime($item[0]->created_at)));
        }

        return [
            'data' => $data,
            'label' => $label
        ];
    }

    public function getNumberOfMemberAndAdmin($gudep = null)
    {
        if($gudep!=null){
            $admin = Anggota::where('status',1)->where('gudep',$gudep)->whereHas('user', function ($query) {
                $query->where('role','gudep');
            })->count();
            $member = Anggota::where('status',1)->where('gudep',$gudep)->count();
        }else{
            $id_wilayah = $this->id_wilayah;
            if($id_wilayah=='all'){
                $admin = Anggota::where('status',1)->whereHas('user', function($q){
                    $q->where('role','kwarda');
                })->count();
                $member = Anggota::where('status',1)->count();
                $type = 1;
            }else{
                $len = strlen($id_wilayah);
                if ($len==2) {
                    $data = Provinsi::where('id',$id_wilayah)->select('id')->first();
                    $type = 2;
                }elseif($len==4){
                    $data =  City::where('id',$id_wilayah)->select('id')->first();
                    $type = 3;
                }else{
                    $data =  Distrik::where('id',$id_wilayah)->select('id')->first();
                    $type = 4;
                }
            }

            if($type==2){
                $admin = Anggota::where('status',1)->where('provinsi',$data->id)->whereHas('user', function ($query) {
                    $query->where('role','kwarda');
                })->get()->count();
                $member = Anggota::where('status',1)->where('provinsi',$data->id)->get()->count();
            }elseif($type==3){
                $admin = Anggota::where('status',1)->where('kabupaten',$data->id)->whereHas('user', function ($query) {
                    $query->where('role','kwarcab');
                })->get()->count();
                $member = Anggota::where('status',1)->where('kabupaten',$data->id)->count();
            }elseif($type==4){
                $admin = Anggota::where('status',1)->where('kecamatan',$data->id)->whereHas('user', function ($query) {
                    $query->where('role','kwaran');
                })->count();
                $member = Anggota::where('status',1)->where('kecamatan',$data->id)->count();
            }

        }


        return [
            'admin' => $admin,
            'anggota' => $member
        ];
    }

    public function getNumberOfTitle()
    {
        $id_wilayah = $this->id_wilayah;
        if($this->gudep==null){
            if($id_wilayah=='all'){
                $query = Anggota::where('status',1)->get(['id','tingkat']);
            }else{
                $len = strlen($id_wilayah);
                if ($len==2) {
                    $query = Anggota::where('status',1)->where('provinsi',$id_wilayah)->get(['id','tingkat']);
                }elseif($len==4){
                    $query =  Anggota::where('status',1)->where('kabupaten',$id_wilayah)->get(['id','tingkat']);
                }else{
                    $query =  Anggota::where('status',1)->where('kecamatan',$id_wilayah)->get(['id','tingkat']);
                }
            }
        }else{
            $query = Anggota::where('status',1)->where('gudep',$this->gudep)->get(['id','tingkat']);
        }

        $count = array();
        $label = array();
        $documents = DocumentType::get(['id','pramuka_id','name'])->groupBy('pramuka_id');
        foreach ($documents as $idx => $pramuka ) {
            $count[$idx] = array();
            $label[$idx] = array();
            foreach ($pramuka as $document ) {
                $counts = $query->where('tingkat',$document->id)->count();
                $counts = $counts == 0 ? 0 : $counts;
                $name = $document->name;
                array_push($label[$idx],$name);
                array_push($count[$idx],$counts);
            }
        }

        $new = array();
        foreach($count AS $key => $value) {
            $new[$key] = [
                'label' => $label[$key],
                'value' => $value
            ];
        }

        return [
            'siaga' => $new[1],
            'penggalang' => $new[2],
            'penegak' => $new[3],
            'pandega' => $new[4],
            'dewasa' => $new[5],
        ];
    }

    public function dashboard()
    {
        $pramuka = $this->getNumberOfPramuka();
        $gender = $this->getGender(true);
        $active = $this->getAnggotaActiveAndUnactive();
        $gudep = $this->getAnggotaGudepAndNonGudep();
        $statistik = $this->getNumberOfAnggotaInYear();
        $tingkat = $this->getNumberOfTitle();

        return [
            'pramuka' => $pramuka,
            'gender' => $gender,
            'active' => $active,
            'gudep' => $gudep,
            'statistik' => $statistik,
            'tingkat' => $tingkat,
        ];
    }
}

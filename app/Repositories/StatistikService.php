<?php namespace App\Repositories;

use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\DocumentType;
use App\Models\Provinsi;
use Carbon\Carbon;

class StatistikService {

    private $id_wilayah;
    public function __construct($id_wilayah)
    {
        $this->id_wilayah = $id_wilayah;
    }

    public function getGender()
    {
        $id_wilayah = $this->id_wilayah;
        if($id_wilayah=='all'){
            $male = Anggota::where('jk','Laki-Laki')->count();
            $female = Anggota::where('jk',0)->count();
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $male = Anggota::where('provinsi',$id_wilayah)->where('jk','Laki-Laki')->count();
                $female = Anggota::where('provinsi',$id_wilayah)->where('jk',0)->count();
            }elseif($len==4){
                $male =  Anggota::where('kabupaten',$id_wilayah)->where('jk','Laki-Laki')->count();
                $female =  Anggota::where('kabupaten',$id_wilayah)->where('jk',0)->count();
            }else{
                $male =  Anggota::where('kecamatan',$id_wilayah)->where('jk','Laki-Laki')->count();
                $female =  Anggota::where('kecamatan',$id_wilayah)->where('jk',0)->count();
            }
        }

        return [
            'male' => $male,
            'female' => $female
        ];
    }

    public function getAnggotaActiveAndUnactive()
    {
        $id_wilayah = $this->id_wilayah;
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

        return [
            'active' => $active,
            'unactive' => $unactive
        ];
    }

    public function getAnggotaGudepAndNonGudep()
    {
        $id_wilayah = $this->id_wilayah;
        if($id_wilayah=='all'){
            $gudep = Anggota::where('gudep','>',0)->count();
            $non_gudep = Anggota::where('gudep','!=',null)->count();
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $gudep = Anggota::where('provinsi',$id_wilayah)->where('gudep','>',0)->count();
                $non_gudep = Anggota::where('provinsi',$id_wilayah)->where('gudep','!=',null)->count();
            }elseif($len==4){
                $gudep =  Anggota::where('kabupaten',$id_wilayah)->where('gudep','>',0)->count();
                $non_gudep =  Anggota::where('kabupaten',$id_wilayah)->where('gudep','!=',null)->count();
            }else{
                $gudep =  Anggota::where('kecamatan',$id_wilayah)->where('gudep','>',0)->count();
                $non_gudep =  Anggota::where('kecamatan',$id_wilayah)->where('gudep','!=',null)->count();
            }
        }

        return [
            'gudep' => $gudep,
            'non_gudep' => $non_gudep
        ];
    }

    public function getNumberOfPramuka()
    {
        $id_wilayah = $this->id_wilayah;
        if($id_wilayah=='all'){
            $siaga = Anggota::where('pramuka',1)->count();
            $penggalang = Anggota::where('pramuka',2)->count();
            $penegak = Anggota::where('pramuka',3)->count();
            $pandega = Anggota::where('pramuka',4)->count();
            $dewasa = Anggota::where('pramuka',5)->count();
            $pelatih = Anggota::where('pramuka',6)->count();
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $query = Anggota::where('provinsi',$id_wilayah)->get();
            }elseif($len==4){
                $query = Anggota::where('kabupaten',$id_wilayah)->get();
            }else{
                $query = Anggota::where('kecamatan',$id_wilayah)->get();
            }

            $siaga = $query->where('pramuka',1)->count();
            $penggalang = $query->where('pramuka',2)->count();
            $penegak = $query->where('pramuka',3)->count();
            $pandega = $query->where('pramuka',4)->count();
            $dewasa = $query->where('pramuka',5)->count();
            $pelatih = $query->where('pramuka',6)->count();
        }

        return [
            'siaga' => $siaga,
            'penggalang' => $penggalang,
            'penegak' => $penegak,
            'pandega' => $pandega,
            'dewasa' => $dewasa,
            'pelatih' => $pelatih
        ];
    }

    public function getNumberOfAnggotaInYear($year = null)
    {
        if ($year==null) {
            $year = date('Y');
        }
        $id_wilayah = $this->id_wilayah;
        if($id_wilayah=='all'){
            $query = Anggota::query();
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $query = Anggota::query()->where('provinsi',$id_wilayah);
            }elseif($len==4){
                $query =  Anggota::query()->where('kabupaten',$id_wilayah);
            }else{
                $query =  Anggota::query()->where('kecamatan',$id_wilayah);
            }
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

    public function getNumberOfTitle()
    {
        $id_wilayah = $this->id_wilayah;
        if($id_wilayah=='all'){
            $query = Anggota::get('id');
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $query = Anggota::where('provinsi',$id_wilayah)->get(['id','tingkat']);
            }elseif($len==4){
                $query =  Anggota::where('kabupaten',$id_wilayah)->get(['id','tingkat']);
            }else{
                $query =  Anggota::where('kecamatan',$id_wilayah)->get(['id','tingkat']);
            }
        }

        $count = array();
        $label = array();
        $document = DocumentType::get(['id','pramuka_id','name'])->groupBy('pramuka_id');
        foreach ($document as $idx => $pramuka ) {
            $count[$idx] = array();
            $label[$idx] = array();
            foreach ($pramuka as $document ) {
                $counts = $query->where('tingkat',$document->id)->count();
                $counts = $counts == 0 ? 1 : $counts;
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
        $gender = $this->getGender();
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

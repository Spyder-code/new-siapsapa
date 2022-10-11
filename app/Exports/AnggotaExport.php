<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class AnggotaExport implements FromView
{

    private $gudep_id;

    function __construct($gudep_id)
    {
        $this->gudep_id = $gudep_id;
    }


    public function view(): View
    {
        $data = Anggota::all()->where('gudep',$this->gudep_id);
        return view('export.anggota', compact('data'));
    }
}

<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AnggotaImport implements ToCollection, SkipsEmptyRows, WithStartRow
{

    private $data;
    public function collection(Collection $rows)
    {
        $data = array();
        foreach ($rows as $row)
        {
            array_push($data, array(
                'nik' => $row[1],
                'nama' => $row[2],
                'tempat_lahir' => $row[3],
                'tgl_lahir' => $row[4],
                'alamat' => $row[5],
                'agama' => $row[6],
                'email' => $row[7],
                'no_hp' => $row[8],
                'jk' => $row[9],
                'gol_darah' => $row[10],
                'keterangan' => $row[11]
            ));
        }

        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function startRow(): int
    {
        return 2;
    }

}

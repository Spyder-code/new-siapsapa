<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncGudepCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $anggota;
    public function __construct($anggota)
    {
        $this->anggota = $anggota;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->anggota as $key => $item) {
            $kode = $item->kode;
            $depan = substr($kode,0,9);
            $belakang = substr($kode,12,18);
            $lk = $item->gudepInfo->no_putra;
            $pr = $item->gudepInfo->no_putri;
            if ($item->jk=='L') {
                $new = $depan.$lk.$belakang;
            }else{
                $new = $depan.$pr.$belakang;
            }
            $item->update([
                'kode' => $new
            ]);
        }
    }
}

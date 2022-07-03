<?php

namespace App\Jobs;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncGolongan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
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
        foreach ($this->anggota as $item ) {
            if($item->tingkat >= 13 ){
                $golongan = 6;
            }else{
                if($item->kawin==1){
                    $golongan = 5;
                }else{
                    $tgl = new DateTime($item->tgl_lahir);
                    $now = new DateTime();
                    $difference = $tgl->diff($now);
                    $usia   = $difference->y; //hitung tahun
                    if ($usia < 10) {
                        $golongan = 1;
                    } else if ($usia >= 10 && $usia <= 15) {
                        $golongan = 2;
                    } else if ($usia >= 16 && $usia <= 20) {
                        $golongan = 3;
                    } else if ($usia >= 21 && $usia < 25) {
                        $golongan = 4;
                    } else if ($usia >= 25) {
                        $golongan = 5;
                    }
                }
            }
            $item->update(['pramuka'=>$golongan]);
        }
    }
}

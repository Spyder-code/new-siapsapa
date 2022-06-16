<?php

namespace App\Jobs;

use App\Models\Kta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncAnggotaKta implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $anggota;
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
            $kta = Kta::where('kabupaten',$item->kabupaten)->first();
            if($kta){
                $item->update(['kta_id'=>$kta->id]);
            }
        }
    }
}

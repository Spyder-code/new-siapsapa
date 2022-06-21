<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStatusAnggota implements ShouldQueue
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
            if($item->status=='0' || $item->status==0){
                $status = 0;
            }elseif($item->status=='1' || $item->status==1){
                $status = 1;
            }elseif($item->status=='2' || $item->status==2){
                $status = 2;
            }elseif($item->status=='3' || $item->status==3){
                $status = 3;
            }

            $item->update(['status'=>$status]);
        }
    }
}

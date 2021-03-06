<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SyncFoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

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
            $old_path = public_path('berkas/anggota');
            if($item->gudep==null){
                $new_path = public_path('berkas/foto/'.$item->provinsi.'/'.$item->kabupaten.'/'.$item->kecamatan);
            }else{
                $new_path = public_path('berkas/foto/'.$item->provinsi.'/'.$item->kabupaten.'/'.$item->kecamatan.'/'.$item->gudep);
            }
            $filename = $item->foto;
            // Storage::move_uploaded_file($old_path.'/'.$filename, $new_path.'/'.$filename);
            if (! File::exists($new_path)) {
                File::makeDirectory($new_path,  0755, true, true);
            }
            if (File::exists($old_path.'/'.$filename)) {
                File::copy(
                    $old_path.'/'.$filename,
                    $new_path.'/'.$filename
                );
            }
        }
    }
}

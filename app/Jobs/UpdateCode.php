<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    private $code;
    private $offset;
    public function __construct($data, $code, $offset)
    {
        $this->data = $data;
        $this->code = $code;
        $this->offset = $offset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $key => $value) {
            $value->kode = substr_replace($value->kode, $this->code, $this->offset, 2);
            // $value->kode = '99.0'.$value->kode;
            $value->save();
        }
    }
}

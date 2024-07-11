<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueueDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $documento;
    protected $exercicio;

    public function __construct($documento, $exercicio)
    {
        $this->documento = $documento;
        $this->exercicio = $exercicio;
    }

    public function handle()
    {
        //
    }
}

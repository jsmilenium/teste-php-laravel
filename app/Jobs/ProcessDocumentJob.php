<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ProcessDocumentJob implements ShouldQueue
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
        $category = Category::firstOrCreate([
            'name' => $this->documento['categoria'],
            'slug' => Str::slug($this->documento['categoria']),
        ]);

        Document::create([
            'category_id' => $category->id,
            'exercise_year' => $this->exercicio,
            'title' => $this->documento['titulo'],
            'contents' => $this->documento['conteudo'],
        ]);
    }
}

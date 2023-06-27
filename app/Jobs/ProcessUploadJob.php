<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Document;

class ProcessUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->process($this->data);
    }

    private function process($data): void
    {

        foreach($data['documentos'] as $key => $value) {

            $category = Category::create([
                'name' => $value['categoria'],
                'slug' => Str::slug($value['categoria'])
            ]);

            Document::create([
                'category_id' => $category->id,
                'title' => $value['titulo'],
                'contents' => $value['conteudo']
            ]);
        }
    }
}

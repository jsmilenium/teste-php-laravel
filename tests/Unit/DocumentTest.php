<?php

namespace Tests\Unit;

use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    protected $data;

    public function setUp(): void
    {
        parent::setUp();

        $json = Storage::get('2023-03-28.json');
        $this->data = json_decode($json, true);
    }

    public function test_conteudo_max_length()
    {
        foreach ($this->data['documentos'] as $documento) {
            $document = new Document($documento);
            $this->assertLessThanOrEqual(500, strlen($document->conteudo));
        }
    }

    public function test_categoria_remessa_validation()
    {
        foreach ($this->data['documentos'] as $documento) {
            if ($documento['categoria'] === 'Remessa') {
                $this->assertStringContainsString('semestre', $documento['titulo']);
            }
        }
    }

    public function test_categoria_remessa_parcial_validation()
    {
        $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        foreach ($this->data['documentos'] as $documento) {
            if ($documento['categoria'] === 'Remessa Parcial') {
                $this->assertContains(strtolower($documento['titulo']), array_map('strtolower', $meses));
            }
        }
    }

}

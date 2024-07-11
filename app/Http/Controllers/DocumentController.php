<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDocumentJob;
use Illuminate\Http\Request;
use App\Jobs\QueueDocumentJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        return view('documents.index');
    }

    public function queueImport(Request $request)
    {
        try {
            $json = Storage::get('2023-03-28.json');
            $data = json_decode($json, true);

            if (!Storage::exists('2023-03-28.json')) {
                return back()->with('error', 'Arquivo JSON não encontrado.');
            }

            if ($data === null || json_last_error() !== JSON_ERROR_NONE) {
                return back()->with('error', 'Erro ao decodificar o JSON: ' . json_last_error_msg());
            }

            if (!isset($data['documentos']) || !isset($data['exercicio'])) {
                return back()->with('error', 'Estrutura do JSON inválida. Faltam os arrays "documentos" ou "exercicio".');
            }

            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->with('error', 'Erro ao decodificar o JSON.');
            }

            foreach ($data['documentos'] as $documento) {
                Redis::rpush('document_queue', json_encode(['documento' => $documento, 'exercicio' => $data['exercicio']]));
            }

            return back()->with('success', 'Importação iniciada!');

        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao ler o arquivo JSON: ' . $e->getMessage());
        }
    }

    public function processQueue()
    {
        while ($dataJson = Redis::lpop('document_queue')) {
            $data = json_decode($dataJson, true);
            $documento = $data['documento'];
            $exercicio = $data['exercicio'];

            ProcessDocumentJob::dispatch($documento, $exercicio);
        }

        return back()->with('success', 'Fila de importação processada com sucesso!');
    }
}

<!DOCTYPE html>
<html>
<head>
    <title>Importação de Documentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('documents.queueImport') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-block mb-3">Importar para a Fila</button>
            </form>

            <form action="{{ route('documents.processQueue') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-block">Processar Fila</button>
            </form>

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>

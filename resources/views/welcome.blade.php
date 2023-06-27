<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Upload de Arquivo JSON</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2>Upload JSON File</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="json" class="form-label">Select a JSON file:</label>
            <input type="file" class="form-control" id="json" name="json" accept=".json" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <br>
    <button type="button" class="btn btn-success" onclick="window.location='{{ route("process") }}'">Process Queue</button>
</div>
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
</body>
</html>

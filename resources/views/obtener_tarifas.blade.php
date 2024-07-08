<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Tarifas Starken</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Buscar Tarifas Starken</h1>
            <form id="buscar-tarifas-form" method="POST" action="{{ route('buscarTarifas') }}">
                @csrf
                <div class="field">
                    <label class="label" for="ciudad">Ciudad</label>
                    <div class="control">
                        <input class="input" type="text" id="ciudad" name="ciudad" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="comuna">Comuna</label>
                    <div class="control">
                        <input class="input" type="text" id="comuna" name="comuna" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button is-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            @if(isset($resultados))
                <h2 class="title is-4">Resultados</h2>
                <pre>{{ json_encode($resultados, JSON_PRETTY_PRINT) }}</pre>
            @endif
        </div>
    </section>
</body>
</html>

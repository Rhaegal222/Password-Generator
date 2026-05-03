<!DOCTYPE html>
<html lang="it">
@php
    $basePath = rtrim(config('app.base_path', ''), '/');
    $manifestPath = public_path('build/manifest.json');
    $manifest = is_file($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];
    $cssEntry = $manifest['resources/css/app.css']['file'] ?? null;
    $jsEntry = $manifest['resources/js/app.js']['file'] ?? null;
    $assetPath = static fn (?string $path) => $path ? ($basePath . '/build/' . ltrim($path, '/')) : null;
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-path" content="{{ $basePath }}">
    <title>Password Generator · Wyrmrest</title>
    <link rel="icon" href="{{ $basePath }}/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="{{ $basePath }}/ui-core.css">
    @if($cssEntry)
        <link rel="stylesheet" href="{{ $assetPath($cssEntry) }}">
    @endif
    @if($jsEntry)
        <script type="module" src="{{ $assetPath($jsEntry) }}"></script>
    @endif
</head>
<body>

<main>
    <div>
        <header>
            <div>
                <span aria-hidden="true"></span>
                <div>
                    <p>Wyrmrest public tool</p>
                    <h1>Password Generator</h1>
                </div>
            </div>
            <p>Generatore operativo con layout a due livelli: brand a sinistra, controlli e output a destra. Nessun look da landing generica.</p>
            <div aria-label="Caratteristiche">
                <span>Token Wyrmrest</span>
                <span>Dark baseline</span>
                <span>Touch 44px</span>
            </div>
            <a href="/">Torna all'Hub</a>
        </header>

        <section aria-labelledby="generator-title">
            <div>
                <div>
                    <div>
                        <p>Output</p>
                        <h2 id="generator-title">Password pronta all'uso</h2>
                    </div>
                    <button id="copy" aria-label="Copia password">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

                <label for="password">Password generata</label>
                <input type="text" id="password" disabled placeholder="Password generata">
                <div>
                    <span>Monospace</span>
                    <span>Copia rapida</span>
                    <span>No scroll orizzontale</span>
                </div>
            </div>

            <div>
                <div>
                    <div>
                        <div>
                            <label for="slider">Lunghezza password</label>
                            <input type="range" id="slider" min="6" max="128" value="12">
                        </div>
                        <div>
                            <label for="length">Caratteri</label>
                            <input type="number" id="length" min="6" max="128" value="12">
                        </div>
                    </div>

                    <fieldset>
                        <legend>Modalità</legend>
                        @foreach([
                            ['easy-say',  'Facile da pronunciare', 'Evita numeri e caratteri speciali'],
                            ['easy-read', 'Facile da leggere', 'Evita caratteri ambigui: l, I, 1, O, 0'],
                            ['all', 'Tutti i caratteri', 'Usa qualunque combinazione consentita'],
                        ] as [$val, $label, $tip])
                        <label>
                            <input type="radio" name="mode" id="mode-{{ $val }}" value="{{ $val }}" @if($val === 'all') checked @endif>
                            <span>{{ $label }}</span>
                            <span>
                                <span aria-hidden="true">i</span>
                                <span>{{ $tip }}</span>
                            </span>
                        </label>
                        @endforeach
                    </fieldset>

                    <fieldset>
                        <legend>Set caratteri</legend>
                        <div>
                            @foreach([
                                ['uppercase', 'Maiuscole'],
                                ['lowercase', 'Minuscole'],
                                ['numbers', 'Numeri'],
                                ['symbols', 'Simboli'],
                            ] as [$id, $label])
                            <label>
                                <input type="checkbox" id="{{ $id }}" checked>
                                <span>{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </fieldset>
                </div>

                <button id="generate">Genera password</button>
            </div>
        </section>
    </div>
</main>

</body>
</html>

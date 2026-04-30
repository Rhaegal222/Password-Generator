<!DOCTYPE html>
<html lang="it" data-wr-theme="default-dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-path" content="{{ rtrim(config('app.base_path', ''), '/') }}">

    <title>Password Generator · Wyrmrest</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-wr-canvas text-wr-text-primary">

<main class="pg-shell">
    <div class="pg-grid">
        <header class="wr-panel pg-hero">
            <div class="pg-hero__top">
                <span class="pg-mark" aria-hidden="true">🔐</span>
                <div>
                    <p class="wr-eyebrow">Wyrmrest public tool</p>
                    <h1 class="pg-title">Password Generator</h1>
                </div>
            </div>
            <p class="pg-copy">Generatore operativo con layout a due livelli: brand a sinistra, controlli e output a destra. Nessun look da landing generica.</p>
            <div class="pg-badges" aria-label="Caratteristiche">
                <span class="pg-badge">Token Wyrmrest</span>
                <span class="pg-badge">Dark baseline</span>
                <span class="pg-badge">Touch 44px</span>
            </div>
            <a href="/" class="wr-button wr-button-secondary pg-home">Torna all'Hub</a>
        </header>

        <section class="wr-panel pg-workbench" aria-labelledby="generator-title">
            <div class="pg-output">
                <div class="pg-output__meta">
                    <div>
                        <p class="wr-eyebrow">Output</p>
                        <h2 id="generator-title" class="pg-section-title">Password pronta all'uso</h2>
                    </div>
                    <button id="copy" class="wr-icon-button" aria-label="Copia password">
                        <span aria-hidden="true">⧉</span>
                    </button>
                </div>

                <label for="password" class="sr-only">Password generata</label>
                <input type="text" id="password" disabled
                       class="pg-password"
                       placeholder="Password generata">
                <div class="pg-output__chips">
                    <span class="pg-chip">Monospace</span>
                    <span class="pg-chip">Copia rapida</span>
                    <span class="pg-chip">No scroll orizzontale</span>
                </div>
            </div>

            <div class="pg-controls">
                <div class="grid gap-wr-16 rounded-wr-lg border border-wr-border-subtle bg-wr-surface p-wr-16">
                    <div class="pg-length">
                        <div>
                            <label for="slider" class="wr-label">Lunghezza password</label>
                            <input type="range" id="slider" min="6" max="128" value="12" class="wr-range">
                        </div>
                        <div>
                            <label for="length" class="wr-label">Caratteri</label>
                            <input type="number" id="length" min="6" max="128" value="12" class="wr-input h-11 text-center">
                        </div>
                    </div>

                    <fieldset class="grid gap-wr-8">
                        <legend class="wr-label">Modalità</legend>
                    @foreach([
                        ['easy-say',  'Facile da pronunciare', 'Evita numeri e caratteri speciali'],
                        ['easy-read', 'Facile da leggere', 'Evita caratteri ambigui: l, I, 1, O, 0'],
                        ['all', 'Tutti i caratteri', 'Usa qualunque combinazione consentita'],
                    ] as [$val, $label, $tip])
                    <label class="wr-choice">
                        <input type="radio" name="mode" id="mode-{{ $val }}" value="{{ $val }}" @if($val === 'all') checked @endif>
                        <span>{{ $label }}</span>
                        <span class="tooltip">
                            <span class="wr-info" aria-hidden="true">i</span>
                            <span class="tooltip-text">{{ $tip }}</span>
                        </span>
                    </label>
                    @endforeach
                    </fieldset>

                    <fieldset class="grid gap-wr-8">
                        <legend class="wr-label">Set caratteri</legend>
                        <div class="grid gap-wr-8 sm:grid-cols-2">
                            @foreach([
                                ['uppercase', 'Maiuscole'],
                                ['lowercase', 'Minuscole'],
                                ['numbers', 'Numeri'],
                                ['symbols', 'Simboli'],
                            ] as [$id, $label])
                            <label class="wr-choice">
                                <input type="checkbox" id="{{ $id }}" checked>
                                <span>{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </fieldset>
                </div>

                <button id="generate" class="wr-button wr-button-primary pg-generate">
                    Genera password
                </button>
            </div>
        </section>
    </div>
</main>

</body>
</html>

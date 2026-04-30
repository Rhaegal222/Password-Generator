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

<main class="min-h-screen px-wr-16 py-wr-24 lg:py-wr-32">
    <div class="mx-auto grid w-full max-w-5xl gap-wr-16 lg:grid-cols-[0.9fr_1.1fr]">
        <header class="wr-panel flex flex-col justify-between gap-wr-24">
            <div class="flex items-center gap-wr-16">
                <span class="grid h-16 w-16 place-items-center rounded-wr-lg border border-wr-border-strong bg-wr-elevated text-3xl" aria-hidden="true">🔐</span>
                <div>
                    <p class="wr-eyebrow">Wyrmrest public tool</p>
                    <h1 class="text-4xl font-black tracking-wide text-wr-text-primary">Password Generator</h1>
                </div>
            </div>
            <p class="text-wr-18 leading-relaxed text-wr-text-secondary">Genera password robuste con regole esplicite, senza uscire dal linguaggio visivo Wyrmrest.</p>
            <a href="/" class="wr-button wr-button-secondary self-start">Torna all'Hub</a>
        </header>

        <section class="wr-panel grid gap-wr-16" aria-labelledby="generator-title">
            <div>
                <p class="wr-eyebrow">Output</p>
                <h2 id="generator-title" class="text-2xl font-extrabold text-wr-text-primary">Password pronta all'uso</h2>
            </div>

            <div class="relative">
                <label for="password" class="sr-only">Password generata</label>
                <input type="text" id="password" disabled
                       class="wr-input h-14 pr-16 font-mono text-wr-16"
                       placeholder="Password generata">
                <button id="copy" class="wr-icon-button absolute inset-y-0 right-wr-8 my-auto" aria-label="Copia password">
                    <span aria-hidden="true">⧉</span>
                </button>
            </div>

            <div class="grid gap-wr-16 rounded-wr-lg border border-wr-border-subtle bg-wr-surface p-wr-16">
                <div class="grid gap-wr-12 md:grid-cols-[minmax(0,1fr)_96px]">
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

            <button id="generate" class="wr-button wr-button-primary min-h-[44px] w-full text-wr-16">
                Genera password
            </button>
        </section>
    </div>
</main>

</body>
</html>

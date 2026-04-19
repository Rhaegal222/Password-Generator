<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-path" content="{{ rtrim(config('app.base_path', ''), '/') }}">

    <title>Password Generator</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=allerta-stencil:400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<img id="background" class="absolute w-full h-full object-cover"
     src="https://4kwallpapers.com/images/wallpapers/neon-circles-hi-tech-dark-background-loop-5k-8k-7680x4320-8312.png"
     alt="">

<div class="flex w-full min-h-screen flex-col items-center justify-center selection:bg-[#BE167A] selection:text-white">
    <div class="relative w-full lg:max-w-7xl">

        <header class="flex justify-center gap-2 py-10">
            <div class="flex select-none">
                <svg width="100" height="100" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="lockGradient" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#BE167A"/>
                            <stop offset="100%" stop-color="#7873F5"/>
                        </linearGradient>
                    </defs>
                    <path d="M16 12V6a4 4 0 0 0-8 0v6H6V6a6 6 0 1 1 12 0v6h-2Z" fill="url(#lockGradient)"/>
                    <rect x="4" y="8" width="16" height="14" rx="3" ry="3" fill="url(#lockGradient)"/>
                    <rect x="11" y="13" width="2" height="5" rx="1" fill="#000"/>
                </svg>
                <div class="flex flex-col justify-center items-start">
                    <h1 style="font-size:2rem; font-family:'Allerta Stencil',sans-serif;"
                        class="text-gradient text-4xl font-bold">
                        Password<br>Generator
                    </h1>
                </div>
            </div>
        </header>

        <main class="flex items-center justify-center select-none">
            <div class="w-full flex flex-col items-center justify-center">

                {{-- Output --}}
                <div class="relative w-2/5">
                    <input type="text" id="password" disabled
                           class="h-12 w-full p-4 pr-12 dark:text-black/70 bg-white rounded-lg border"
                           placeholder="Generated Password">
                    <button id="copy" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                        <i class="material-icons text-gradient">content_copy</i>
                    </button>
                </div>

                {{-- Options panel --}}
                <div class="mt-4 flex flex-col w-2/5 p-4 bg-white shadow-md border">
                    <h2 class="text-2xl font-bold text-gradient">Customize your password</h2>

                    {{-- Length --}}
                    <div class="flex flex-row items-center justify-evenly gap-4 mt-4">
                        <label for="length" class="text-lg font-bold text-gradient whitespace-nowrap">Password Length</label>
                        <input type="number" id="length" min="6" max="128" value="12"
                               class="h-12 w-18 text-center dark:text-black/70 bg-white border">
                        <input type="range" id="slider" min="6" max="128" value="12"
                               class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-fuchsia-900">
                    </div>

                    {{-- Mode --}}
                    <div class="flex flex-col gap-4 mt-4">
                        @foreach([
                            ['easy-say',  'Easy to say',    'Avoid numbers and special characters'],
                            ['easy-read', 'Easy to read',   'Avoid ambiguous characters: l, I, 1, O, 0'],
                            ['all',       'All characters', 'Any character combinations'],
                        ] as [$val, $label, $tip])
                        <div class="flex items-center gap-2">
                            <input type="radio" name="mode" id="mode-{{ $val }}" value="{{ $val }}"
                                   @if($val === 'all') checked @endif
                                   class="form-radio text-gradient focus:ring-0 cursor-pointer">
                            <label for="mode-{{ $val }}" class="text-base dark:text-black/70">{{ $label }}</label>
                            <div class="tooltip">
                                <i class="material-icons text-gradient cursor-pointer">info</i>
                                <span class="tooltip-text border">{{ $tip }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Character types --}}
                    <div class="mt-4 grid grid-cols-2 gap-2">
                        @foreach([
                            ['uppercase', 'Uppercase'],
                            ['lowercase', 'Lowercase'],
                            ['numbers',   'Numbers'],
                            ['symbols',   'Symbols'],
                        ] as [$id, $label])
                        <label class="flex items-center gap-2 dark:text-black/70 cursor-pointer">
                            <input type="checkbox" id="{{ $id }}" checked
                                   class="form-checkbox focus:ring-0 cursor-pointer">
                            <span>{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button id="generate"
                        class="mt-4 w-1/5 px-6 py-3 text-lg font-bold text-white button rounded-lg">
                    Generate
                </button>

            </div>
        </main>
    </div>
</div>

</body>
</html>

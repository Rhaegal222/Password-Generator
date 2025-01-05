<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Password Generator</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=allerta-stencil:400&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
    <img id="background" class="absolute w-full h-full object-cover"
         src="https://4kwallpapers.com/images/wallpapers/neon-circles-hi-tech-dark-background-loop-5k-8k-7680x4320-8312.png"
         alt="Password Generator Background"/>
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

                        <rect x="4" y="8" width="16" height="14" rx="3" ry="3" fill="url(#lockGradient)"/>

                        <rect x="11" y="13" width="2" height="5" rx="1" fill="#000"/>

                        <path d="M16 8V6a4 4 0 0 0-8 0v2H6V6a6 6 0 0 1 12 0v2h-2Z" fill="url(#lockGradient)"/>
                    </svg>

                    <div class="flex flex-col justify-center items-start">
                        <h1 class="text-gradient text-4xl font-bold"
                            style="font-size: 2rem; font-family: 'Allerta Stencil', sans-serif; display: block;">
                            Password<br>Generator
                        </h1>
                    </div>
                </div>
            </header>

            <main class="flex items-center justify-center select-none">
                <div class="w-full flex flex-col items-center justify-center">

                    <div class="relative w-2/5">
                        <input type="text" id="password" name="password"
                               class="h-12 w-full p-4 pr-12 dark:text-black/70 bg-white rounded-lg border"
                               placeholder="Generated Password"/>

                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                            <i class="material-icons text-gradient" onclick="copyToClipboard()">content_copy</i>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-col w-2/5 p-4 bg-white shadow-md border">
                        <h2 class="text-2xl font-bold text-gradient">Customize your password</h2>

                        <div class="flex flex-row items-center justify-evenly gap-4 mt-4">
                            <label for="length" class="text-lg font-bold text-gradient whitespace-nowrap">Password Length</label>

                            <input type="number" id="length" name="length" min="1" max="128" value="12"
                                   class="h-12 w-18 text-center dark:text-black/70 bg-white border"
                                   placeholder="Length"/>

                            <input type="range" id="slider" name="slider" min="1" max="128" value="12"
                                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-fuchsia-900"/>
                        </div>

                        <!-- Options Section -->
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="type" id="easy-say"
                                       class="form-radio text-gradient focus:ring-0 cursor-pointer"/>
                                <label for="easy-say" class="text-base dark:text-black/50">Easy to say</label>
                                <i class="material-icons text-gradient cursor-pointer">info</i>
                            </div>

                            <div class="flex items-center gap-2">
                                <input type="radio" name="type" id="easy-read"
                                       class="form-radio text-gradient focus:ring-0 cursor-pointer"/>
                                <label for="easy-read" class="text-base dark:text-black/50">Easy to read</label>
                                <i class="material-icons text-gradient cursor-pointer">info</i>
                            </div>

                            <div class="flex items-center gap-2 ">
                                <input type="radio" name="type" id="all-characters"
                                       class="form-radio text-gradient focus:ring-0 cursor-pointer"/>
                                <label for="all-characters" class="text-base dark:text-black/50">All characters</label>
                                <i class="material-icons text-gradient cursor-pointer">info</i>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-2 dark:text-black/50">
                            <label class="flex items-center gap-2">
                                <input id="uppercase" name="uppercase" value="true" type="checkbox" checked class="form-checkbox dark:text-black/50 focus:ring-0"/>
                                <span>Uppercase</span>
                            </label>

                            <label class="flex items-center gap-2 dark:text-black/50">
                                <input id="lowercase" name="lowercase" value="true" type="checkbox" checked class="form-checkbox dark:text-black/50 focus:ring-0"/>
                                <span>Lowercase</span>
                            </label>

                            <label class="flex items-center gap-2">
                                <input id="numbers" name="numbers" value="true" type="checkbox" checked class="form-checkbox dark:text-black/50 focus:ring-0"/>
                                <span>Numbers</span>
                            </label>

                            <label class="flex items-center gap-2">
                                <input id="symbols" name="symbols" value="true" type="checkbox" checked class="form-checkbox dark:text-black/50 focus:ring-0"/>
                                <span>Symbols</span>
                            </label>
                        </div>
                    </div>

                    <button id="generate"
                            class="mt-4 w-1/5 px-6 py-3 text-lg font-bold text-white button
                             rounded-lg">
                        Generate
                    </button>
                </div>
            </main>
        </div>
    </div>
</div>

<script>
    document.getElementById('generate').onclick = function(e) {
        e.preventDefault();

        const length = document.getElementById('length').value;
        const includeUppercase = document.getElementById('uppercase').checked;
        const includeLowercase = document.getElementById('lowercase').checked;
        const includeNumbers = document.getElementById('numbers').checked;
        const includeSymbols = document.getElementById('symbols').checked;

        alert(
            length + ' ' + includeUppercase + ' ' + includeLowercase + ' ' + includeNumbers + ' ' + includeSymbols
        )

        fetch(`/password/generate?length=${length}&uppercase=${includeUppercase}&lowercase=${includeLowercase}&numbers=${includeNumbers}&symbols=${includeSymbols}`)
            .then(response => response.text())
            .then(password => {
                const passwordInput = document.getElementById('password');
                passwordInput.value = password;
                navigator.clipboard.writeText(password).then(() => {
                    alert('Password copiata nella clipboard!');
                });
            })
            .catch(error => {
                alert('Errore nella generazione della password');
            });
    }

    document.getElementById('slider').oninput = function () {
        document.getElementById('length').value = this.value;
    }

    document.getElementById('length').oninput = function () {
        document.getElementById('slider').value = this.value;
    }
</script>
</body>
</html>

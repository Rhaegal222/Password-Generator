<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Password Generator</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">

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
<body class="font-sans antialiased">
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

                    <path d="M16 12V6a4 4 0 0 0-8 0v6H6V6a6 6 1 1 1 12 0v6h-2Z" fill="url(#lockGradient)"/>

                    <rect x="4" y="8" width="16" height="14" rx="3" ry="3" fill="url(#lockGradient)"/>

                    <rect x="11" y="13" width="2" height="5" rx="1" fill="#000"/>
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
                    <input type="text" id="password" name="password" disabled
                           class="h-12 w-full p-4 pr-12 dark:text-black/70 bg-white rounded-lg border"
                           placeholder="Generated Password"/>

                    <div id="copy" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                        <i class="material-icons text-gradient">content_copy</i>
                    </div>
                </div>

                <div class="mt-4 flex flex-col w-2/5 p-4 bg-white shadow-md border">
                    <h2 class="text-2xl font-bold text-gradient">Customize your password</h2>

                    <div class="flex flex-row items-center justify-evenly gap-4 mt-4">
                        <label for="length" class="text-lg font-bold text-gradient whitespace-nowrap">Password
                            Length</label>

                        <input type="number" id="length" name="length" min="1" max="128" value="12"
                               class="h-12 w-18 text-center dark:text-black/70 bg-white border"
                               placeholder="Length"/>

                        <input type="range" id="slider" name="slider" min="1" max="128" value="12"
                               class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-fuchsia-900"/>
                    </div>

                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="easy-say" id="easy-say"
                                   class="form-radio text-gradient focus:ring-0 cursor-pointer"/>
                            <label for="easy-say" class="text-base dark:text-black/70">Easy to say</label>
                            <div class="tooltip">
                                <i class="material-icons text-gradient cursor-pointer">info</i>
                                <span class="tooltip-text border">Avoid numbers and special characters</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="radio" name="easy-read" id="easy-read"
                                   class="form-radio text-gradient focus:ring-0 cursor-pointer"/>
                            <label for="easy-read" class="text-base dark:text-black/70">Easy to read</label>
                            <div class="tooltip">
                                <i class="material-icons text-gradient cursor-pointer">info</i>
                                <span class="tooltip-text border">Avoid ambiguous characters like l, I, 1, O, and 0</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 ">
                            <input type="radio" name="all-characters" id="all-characters" checked="checked"
                                   class="form-radio text-gradient focus:ring-0 cursor-pointer"/>
                            <label for="all-characters" class="text-base dark:text-black/70">All characters</label>
                            <div class="tooltip">
                                <i class="material-icons text-gradient cursor-pointer">info</i>
                                <span class="tooltip-text border">Any character combinations like !, 7, h, K, and lI1</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-2">
                        <label class="flex items-center gap-2 dark:text-black/70 cursor-pointer">
                            <input id="uppercase" name="uppercase" value="true" type="checkbox" checked
                                   class="form-checkbox focus:ring-0 cursor-pointer"/>
                            <span>Uppercase</span>
                        </label>

                        <label class="flex items-center gap-2 dark:text-black/70 cursor-pointer">
                            <input id="lowercase" name="lowercase" value="true" type="checkbox" checked
                                   class="form-checkbox focus:ring-0 cursor-pointer"/>
                            <span>Lowercase</span>
                        </label>

                        <label class="flex items-center gap-2 dark:text-black/70 cursor-pointer">
                            <input id="numbers" name="numbers" value="true" type="checkbox" checked
                                   class="form-checkbox focus:ring-0 cursor-pointer"/>
                            <span>Numbers</span>
                        </label>

                        <label class="flex items-center gap-2 dark:text-black/70 cursor-pointer">
                            <input id="symbols" name="symbols" value="true" type="checkbox" checked
                                   class="form-checkbox focus:ring-0 cursor-pointer"/>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = {
            easySay: 'easy-say',
            easyRead: 'easy-read',
            allCharacters: 'all-characters',
            uppercase: 'uppercase',
            lowercase: 'lowercase',
            numbers: 'numbers',
            symbols: 'symbols'
        };

        function updateCheckboxes(config) {
            Object.keys(checkboxes).forEach(key => {
                const checkbox = document.getElementById(checkboxes[key]);
                if (checkbox) {
                    checkbox.checked = config[key] || false;
                    checkbox.disabled = config.disabled?.includes(key) || false;
                }
            });
            updateRadioButtons();
        }

        function updateRadioButtons() {
            const states = ['uppercase', 'lowercase', 'numbers', 'symbols'].map(id => document.getElementById(id).checked);
            const allCharacters = document.getElementById('all-characters');

            const allChecked = states.every(state => state);

            allCharacters.checked = !!allChecked;
        }

        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('click', () => {
                if (radio.id === 'easy-say') {
                    updateCheckboxes({
                        easySay: true,
                        uppercase: true,
                        lowercase: true,
                        numbers: false,
                        symbols: false,
                        disabled: ['numbers', 'symbols']
                    });
                } else if (radio.id === 'easy-read') {
                    updateCheckboxes({
                        easyRead: true,
                        uppercase: true,
                        lowercase: true,
                        numbers: false,
                        symbols: false,
                        disabled: []
                    });
                } else if (radio.id === 'all-characters') {
                    updateCheckboxes({
                        allCharacters: true,
                        uppercase: true,
                        lowercase: true,
                        numbers: true,
                        symbols: true,
                        disabled: []
                    });
                }

                if (radio.id === 'easy-say' || radio.id === 'easy-read') {
                    document.getElementById('all-characters').checked = false;
                }
            });
        });

        function enforceAtLeastOneCheckbox() {
            const checkboxes = ['uppercase', 'lowercase', 'numbers', 'symbols'];
            checkboxes.forEach(id => {
                const checkbox = document.getElementById(id);
                checkbox.addEventListener('change', () => {
                    const activeCheckboxes = checkboxes.filter(id => document.getElementById(id).checked);
                    if (activeCheckboxes.length === 0) {
                        checkbox.checked = true;
                        alert('At least one option must be selected');
                    }
                    updateRadioButtons();
                });
            });
        }

        document.getElementById('copy').onclick = function () {
            const passwordInput = document.getElementById('password');

            if (!passwordInput.value) {
                alert('Please generate a password first');
                return;
            }

            navigator.clipboard.writeText(passwordInput.value).then(() => {
                alert('Password copied to clipboard');
                passwordInput.select();
            }).catch(() => {
                alert('Failed to copy password');
            });
        };

        // Gestione generazione password
        document.getElementById('generate').onclick = function (e) {
            e.preventDefault();

            const length = parseInt(document.getElementById('length').value, 10);
            if (isNaN(length) || length < 8 || length > 32) {
                alert('Password length must be between 8 and 32 characters');
                return;
            }

            const params = new URLSearchParams({
                length: length,
                uppercase: document.getElementById('uppercase').checked,
                lowercase: document.getElementById('lowercase').checked,
                numbers: document.getElementById('numbers').checked,
                symbols: document.getElementById('symbols').checked,
                easyToSay: document.getElementById('easy-say').checked,
                easyToRead: document.getElementById('easy-read').checked
            });

            fetch(`/password/generate?${params.toString()}`)
                .then(response => response.text())
                .then(password => {
                    const passwordInput = document.getElementById('password');
                    passwordInput.value = password;

                    navigator.clipboard.writeText(password).then(() => {
                        alert('Password copied to clipboard');
                        passwordInput.select();
                    });
                }).catch(() => {
                alert('Error generating password');
            });
        };

        const lengthSlider = document.getElementById('slider');
        const lengthInput = document.getElementById('length');

        lengthSlider.oninput = function () {
            lengthInput.value = this.value;
        };

        lengthInput.oninput = function () {
            lengthSlider.value = this.value;
        };

        enforceAtLeastOneCheckbox();
    });
</script>
</body>
</html>

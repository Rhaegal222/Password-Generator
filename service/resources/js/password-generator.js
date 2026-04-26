const basePath = document.querySelector('meta[name="base-path"]')?.content ?? '';

document.addEventListener('DOMContentLoaded', () => {
    const lengthSlider = document.getElementById('slider');
    const lengthInput  = document.getElementById('length');
    const passwordInput = document.getElementById('password');
    const generateBtn  = document.getElementById('generate');
    const copyBtn      = document.getElementById('copy');

    const checkboxIds = ['uppercase', 'lowercase', 'numbers', 'symbols'];

    // Sync slider ↔ input
    lengthSlider.addEventListener('input', () => { lengthInput.value = lengthSlider.value; });
    lengthInput.addEventListener('input',  () => { lengthSlider.value = lengthInput.value; });

    // Radio mode switching
    document.querySelectorAll('input[name="mode"]').forEach(radio => {
        radio.addEventListener('change', () => applyMode(radio.value));
    });

    function applyMode(mode) {
        const numbersEl  = document.getElementById('numbers');
        const symbolsEl  = document.getElementById('symbols');

        if (mode === 'easy-say') {
            numbersEl.checked  = false;
            symbolsEl.checked  = false;
            numbersEl.disabled = true;
            symbolsEl.disabled = true;
        } else {
            numbersEl.disabled = false;
            symbolsEl.disabled = false;
        }
    }

    // Keep at least one checkbox active
    checkboxIds.forEach(id => {
        document.getElementById(id).addEventListener('change', () => {
            const active = checkboxIds.filter(i => document.getElementById(i).checked);
            if (active.length === 0) {
                document.getElementById(id).checked = true;
            }
        });
    });

    // Generate
    async function generatePassword() {
        const length = parseInt(lengthInput.value, 10);
        if (isNaN(length) || length < 6 || length > 128) {
            alert('Password length must be between 6 and 128 characters.');
            return;
        }

        const mode = document.querySelector('input[name="mode"]:checked')?.value ?? 'all';

        const params = new URLSearchParams({
            length,
            uppercase:  document.getElementById('uppercase').checked,
            lowercase:  document.getElementById('lowercase').checked,
            numbers:    document.getElementById('numbers').checked,
            symbols:    document.getElementById('symbols').checked,
            easyToSay:  mode === 'easy-say',
            easyToRead: mode === 'easy-read',
        });

        try {
            const res = await fetch(`${basePath}/password/generate?${params}`);
            const text = await res.text();

            if (!res.ok) {
                alert(text);
                return;
            }

            passwordInput.value = text;
        } catch {
            alert('Error generating password. Please try again.');
        }
    }

    generateBtn.addEventListener('click', (e) => {
        e.preventDefault();
        generatePassword();
    });

    // Initial generate
    generatePassword();

    // Copy
    copyBtn.addEventListener('click', () => {
        if (!passwordInput.value) { alert('Generate a password first.'); return; }
        copyToClipboard(passwordInput.value);
    });

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).catch(() => {});
    }
});

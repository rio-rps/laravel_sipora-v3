function togglePassword(fieldId, btn) {
    const field = document.getElementById(fieldId);
    const icon = btn.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
} 

function checkPasswordStrength(password) {
    const bar = document.getElementById('password-strength-fill');
    const text = document.getElementById('password-strength-text');

    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[@$!%*#?&.,:;^_\-]/.test(password)) strength++;

    let width = '0%';
    let color = 'red';
    let label = 'Lemah';

    if (strength <= 2) {
        width = '33%';
        color = 'red';
        label = 'Lemah';
    } else if (strength === 3 || strength === 4) {
        width = '66%';
        color = 'orange';
        label = 'Sedang';
    } else if (strength === 5) {
        width = '100%';
        color = 'green';
        label = 'Kuat';
    }

    bar.style.width = width;
    bar.style.backgroundColor = color;
    text.textContent = 'Kekuatan Password: ' + label;
}

// Cek kesesuaian password konfirmasi
function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('password_confirmation').value;
    const text = document.getElementById('password-match-text');

    if (!confirm) {
        text.textContent = '';
        return;
    }

    if (password === confirm) {
        text.textContent = '✔ Password cocok';
        text.style.color = 'green';
    } else {
        text.textContent = '✖ Password tidak cocok';
        text.style.color = 'red';
    }
}

// Fungsi toggle show/hide password
function togglePassword(id, el) {
    const input = document.getElementById(id);
    const icon = el.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}
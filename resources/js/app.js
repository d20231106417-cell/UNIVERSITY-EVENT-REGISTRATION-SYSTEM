document.querySelectorAll('[data-password-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const input = document.getElementById(button.dataset.passwordToggle);

        if (!input) {
            return;
        }

        const shouldShowPassword = input.type === 'password';
        input.type = shouldShowPassword ? 'text' : 'password';
        button.textContent = shouldShowPassword ? 'Hide' : 'Show';
        button.setAttribute('aria-label', `${shouldShowPassword ? 'Hide' : 'Show'} password`);
        button.setAttribute('aria-pressed', String(shouldShowPassword));
    });
});
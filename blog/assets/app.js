const toggleButton = document.querySelector('[data-theme-toggle]');
const storedTheme = localStorage.getItem('blog-theme');

if (storedTheme) {
    document.documentElement.setAttribute('data-theme', storedTheme);
}

toggleButton?.addEventListener('click', () => {
    const current = document.documentElement.getAttribute('data-theme');
    const next = current === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('blog-theme', next);
});

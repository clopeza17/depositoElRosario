console.log('script.js cargado');
document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    
    if (themeToggle) {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.setAttribute('data-theme', 'dark');
        }
        
        themeToggle.addEventListener('click', (e) => {
            e.preventDefault();
            if (document.body.hasAttribute('data-theme')) {
                document.body.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            } else {
                document.body.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    } else {
        console.warn('El botón de cambio de tema no se encontró en el DOM');
    }
});